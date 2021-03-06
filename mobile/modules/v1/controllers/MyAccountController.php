<?php

namespace mobile\modules\v1\controllers;

use common\helpers\Sms;
use common\models\costfit\Address;
use common\models\costfit\User;
use common\models\costfit\Zipcodes;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\DisplayMyAccount;
use common\models\costfit\ProductShelf;
use common\models\costfit\Wishlist;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\imagine\Image;
use common\helpers\CozxyUnity;
use frontend\controllers\MyAccountController as MyAccountFrontendController;

class MyAccountController extends MyAccountFrontendController
{
    public $enableCsrfValidation = false;

    public function actionChangeAvatar()
    {
        if(isset($_POST['token'])) {
            $res = ['success' => false, 'error' => NULL];
            $token = $_POST['token'];

            $userModel = User::find()->where(['auth_key' => $token])->one();

            if(isset($userModel)) {

                $avatar = UploadedFile::getInstanceByName("avatar");

                if(isset($avatar) && !empty($avatar)) {
                    $imageFileName = explode('.', $avatar->name);
                    $ext = end($imageFileName);
                    $fileName = Yii::$app->security->generateRandomString(12) . '.' . $ext;
                    $filePath = Yii::$app->basePath . '/../frontend/web/images/user/avatar/' . $fileName;

                    $userModel->avatar = $fileName;

                    if($avatar->saveAs($filePath) && $userModel->save(false)) {
                        $res['success'] = true;
                        $res['avatar'] = Yii::$app->params['baseUrl'].DIRECTORY_SEPARATOR . 'images/user/avatar/' . $fileName;
                    }
                } else {
                    $res['error'] = 'Can not uploaded file, please try again';
                }
            } else {
                $res['error'] = 'Error : User not found.';
            }

            return Json::encode($res);
        }
    }

    public function actionBillingAddress()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['items' => [], 'error' => NULL];

        if(isset($contents) && $contents !== []) {
            $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

            if(isset($userModel)) {
                $addressModels = Address::find()
                    ->where(['userId' => $userModel->userId, 'type' => Address::TYPE_BILLING])
                    ->orderBy(['isDefault' => SORT_DESC])
                    ->all();
                $i = 0;
                foreach($addressModels as $addressModel) {
                    $data[$i] = self::prepareAddress($addressModel);
                    $i++;
                }
                $res['items'] = $data;
            }

            echo Json::encode($res);
        }
    }

    public function actionShippingAddress()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['items' => [], 'error' => NULL];

        if(isset($contents) && $contents !== []) {
            $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

            if(isset($userModel)) {
                $addressModels = Address::find()
                    ->where(['userId' => $userModel->userId, 'type' => Address::TYPE_SHIPPING])
                    ->orderBy(['isDefault' => SORT_DESC])
                    ->all();
                $i = 0;
                foreach($addressModels as $addressModel) {
                    $data[$i] = self::prepareAddress($addressModel);
                    $i++;
                }
                $res['items'] = $data;
            }

            echo Json::encode($res);
        }
    }

    public function actionRequestChangeMobile()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => ''];

        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

        if(isset($userModel)) {
            //send confirm code via sms
            $code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $userModel->code = $code;
            $userModel->save(false);

            $res['otp'] = $code;
            $res['success'] = true;
            $tel = self::preparePhoneNumber($userModel->tel);

            Sms::Send('POST', Sms::SMS_URL, Json::encode([
                'from' => 'COZXY',
                'to' => [$tel],
                'text' => "รหัส OTP สำหรับเปลี่ยนเบอร์โทรศัพท์ ของคุณคือ $code"
            ]));

            $a = 0;
        } else {
            $res['error'] = 'Error : User not found';
        }

        echo Json::encode($res);
    }

    public function actionConfirmChangeMobile()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => ''];

        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

        if(isset($userModel)) {
            if($userModel->code == $contents['otp']) {
                $userModel->tel = $contents['newMobile'];
                $userModel->code = '';
                $userModel->save(false);

                $res['success'] = true;
            } else {
                $res['error'] = 'Error : OTP miss match';
            }
        } else {
            $res['error'] = 'Error : User not found.';
        }

        echo Json::encode($res);
    }

    private static function preparePhoneNumber($tel)
    {
        return '66' . substr($tel, 1);
    }

    public function actionSaveAddress()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => ''];

        if(isset($contents) && $contents !== []) {
            $userModel = User::find()->where(['auth_key' => $contents['token']])->one();
            if(isset($userModel)) {
                $addressModel = new Address();
                $addressModel->firstname = $contents['firstname'];
                $addressModel->lastname = $contents['lastname'];
                $addressModel->address = $contents['address'];
                $addressModel->countryId = $contents['countryId'];
                $addressModel->provinceId = $contents['provinceId'];
                $addressModel->amphurId = $contents['amphurId'];
                $addressModel->districtId = $contents['districtId'];
                $addressModel->type = $contents['type'];
                $addressModel->userId = $userModel->userId;
                $addressModel->createDateTime = $addressModel->updateDateTime = new Expression('NOW()');
                $addressModel->tel = $contents['tel'];
                $addressModel->isDefault = $contents['isDefault'];

                //if $contents['isDefault'] = 1 change all isDefault=0
                Address::updateAll(['isDefault' => 0], ['userId' => $userModel->userId, 'type' => $contents['type']]);

                //zipcode
                $zipCode = Zipcodes::find()
                    ->leftJoin('district d', 'd.code=zipcodes.districtCode')
                    ->where(['d.districtId' => $contents['districtId']])
                    ->one();

                $addressModel->zipcode = $zipCode->zipcodeId;

                if($addressModel->save()) {
                    $res['success'] = true;
                    $res['address'] = self::prepareAddress($addressModel);
                } else {
                    $res['error'] = $addressModel->errors;
                }
            } else {
                $res['error'] = 'Error : User not found.';
            }

            echo Json::encode($res);
        }
    }

    private static function prepareAddress($address)
    {
        $zipcde = isset($address->zipcodes->zipcode) ? $address->zipcodes->zipcode : '';

        return [
            'addressId' => $address->addressId,
            'isDefaule' => $address->isDefault,
            'name' => $address->firstname . ' ' . $address->lastname,
            'address' => $address->address . ' ' . $address->district->districtName . ' ' . $address->cities->cityName . ' ' . $address->states->stateName . ' ' . $zipcde,
            'tel' => $address->tel,
        ];
    }

    public function actionChangeMobile()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => ''];
        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

        if(isset($userModel)) {
            $userModel->tel = $contents['mobile'];
            $userModel->callingCode = $contents['callingCode'];
            $userModel->save(false);
            $res['success'] = true;
        } else {
            $res['error'] = 'Error : User not found.';
        }

        echo Json::encode($res);
    }

    /**
     *
     */



    public function actionChangeName()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => ''];
        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

        if(isset($userModel)) {
            if(!empty($contents['firstname'])) {
                $userModel->firstname = $contents['firstname'];
            }

            if(!empty($contents['lastname'])) {
                $userModel->lastname = $contents['lastname'];
            }


            if(!empty($contents['displayName'])) {
                $userModel->displayName = $contents['displayName'];
            }

            $userModel->save(false);
            $res['success'] = true;
        } else {
            $res['error'] = 'Error : User not found.';
        }

        echo Json::encode($res);
    }

    public function actionChangeBirthDate()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => ''];
        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

        if(isset($userModel)) {
            $userModel->birthDate = $contents['birthDate'];

            $userModel->save(false);
            $res['success'] = true;
        } else {
            $res['error'] = 'Error : User not found.';
        }

        echo Json::encode($res);
    }
}
