<?php

namespace mobile\modules\v1\controllers;

use common\models\costfit\Address;
use common\models\costfit\User;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
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
                        $res['avatar'] = Yii::$app->homeUrl.'images/user/avatar/'.$fileName;
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

        if(isset($contents) && $contents !== []) {
            $userModel = User::find()->where(['auth_key'=>$contents['token']])->one();
            $res = ['success' => false, 'error' => NULL];

            if(isset($userModel)) {
                $addressModels = Address::find()->where(['userId'=>$userModel->userId])->all();
            }
        }
    }

    private static function prepareAddress($address)
    {
        return [
            'addressId'=>$address->addressId,
            'name'=>$address->firstname.' '.$address->lastname,
            'address'=>$address->address.' '.$address->district->districtName.' '.$address->cities->cityName.' '.$address->states->stateName
        ];
    }
}
