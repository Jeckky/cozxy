<?php

namespace mobile\modules\v1\controllers;

use common\models\costfit\ProductPost;
use common\models\costfit\ProductPostComparePrice;
use common\models\costfit\ProductPostImages;
use Yii;
use yii\db\Expression;
use yii\db\Exception;
use yii\web\Controller;
use \yii\helpers\Json;
use yii\web\UploadedFile;
use common\models\costfit\User;
use common\models\costfit\CurrencyInfo;

/**
 * Default controller for the `mobile` module
 */
class QuickAddController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionSave()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => NULL];
        $productId = $contents['productId'];
        $memo = $contents['memo'];
        $imageIds = $contents['imageIds'];
        $comparePrice = $contents['comparePrice'];
        $price = $comparePrice['price'];
        $shopName = $comparePrice['shopName'];
        $placeName = $comparePrice['placeName'];
        $latitude = $comparePrice['latitude'];
        $longitude = $comparePrice['longitude'];
        $currencyId = $comparePrice['currencyId'];
        $country = $comparePrice['countryCode'];
        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

        if(isset($userModel)) {
            $userId = $userModel->userId;

            $transaction = Yii::$app->db->beginTransaction();
            $flag = false;

            try {
                //create Product Post isPublic=0, status=2
                $storyModel = new ProductPost();
                $storyModel->shortDescription = $memo;
                $storyModel->productId = $productId;
                $storyModel->createDateTime = new Expression('NOW()');
                $storyModel->updateDateTime = new Expression('NOW()');
                $storyModel->isPublic = 0;
                $storyModel->status = 2;
                $storyModel->userId = $userId;
                $storyModel->save(false);
                $storyId = Yii::$app->db->lastInsertID;

                $currencyInfoModel = CurrencyInfo::find()->where(['currencyId' => $currencyId])->one();

                //create ProductPostPrice
                $productPostComparePriceModel = new ProductPostComparePrice();
                $productPostComparePriceModel->productId = $productId;
                $productPostComparePriceModel->productPostId = $storyId;
                $productPostComparePriceModel->userId = $userId;
                $productPostComparePriceModel->latitude = $latitude;
                $productPostComparePriceModel->longitude = $longitude;
                $productPostComparePriceModel->shopName = $shopName;
                $productPostComparePriceModel->placeName = $placeName;
                $productPostComparePriceModel->price = $price;
                $productPostComparePriceModel->createDateTime = $productPostComparePriceModel->updateDateTime = new Expression('NOW()');
                $productPostComparePriceModel->status = 2;
                $cid = $currencyInfoModel->currencyId;
                settype($cid, 'string');
                $productPostComparePriceModel->currency = $cid;
                $productPostComparePriceModel->country = $country;

                if($productPostComparePriceModel->save()) {
//                    $numRows = ProductPostImages::updateAll(['productPostId' => $storyId], 'imagesId in (' . implode(',', $imageIds) . ')');
//
//                    if($numRows == sizeof($imageIds)) {
//                        $flag = true;
//                    }

                    $imageFiles = new ProductPostImages();
                    $imageFiles->imageFiles = UploadedFile::getInstancesByName('image');

                    $flag = $imageFiles->upload($storyId);
                }

                if($flag) {
                    $transaction->commit();
                    $res['success'] = true;
                } else {
                    $transaction->rollBack();
                    $res['error'] = 'Error :: Please try again' . print_r($productPostComparePriceModel->errors, true);
                }
            }
            catch(Exception $e) {
                $transaction->rollBack();
                $res['error'] = $storyModel->errors;
            }
        } else {
            $res['error'] = 'Error : User not found.';
        }
        return Json::encode($res);
    }

    private static function uploadFile($imageFile)
    {
        $res = ['success' => false, 'error' => NULL];
        $imageFileName = explode('.', $imageFile->name);
        $ext = end($imageFileName);
        $fileName = Yii::$app->security->generateRandomString(12) . '.' . $ext;
//            $fileName = uniqid() . '.' . $ext;
        $fileUrl = 'images/story/' . $fileName;
        $filePath = Yii::$app->basePath . '/../frontend/web/images/story/' . $fileName;

        $productPostImage = new ProductPostImages();
        $productPostImage->picture = $fileUrl;
        $productPostImage->status = 2; //quick add
        $productPostImage->createDateTime = new Expression('NOW()');
        $productPostImage->updateDateTime = new Expression('NOW()');

        if($imageFile->saveAs($filePath) && $productPostImage->save(false)) {
            $res['success'] = true;
            $res['imageId'] = Yii::$app->db->lastInsertID;
        }

        return $res;
    }

    public function actionUploadFile()
    {
        $res = ['success' => false, 'error' => NULL];
        $imageFile = UploadedFile::getInstanceByName("image");

        if(isset($imageFile) && !empty($imageFile)) {
            $imageFileName = explode('.', $imageFile->name);
            $ext = end($imageFileName);
            $fileName = Yii::$app->security->generateRandomString(12) . '.' . $ext;
//            $fileName = uniqid() . '.' . $ext;
            $fileUrl = 'images/story/' . $fileName;
            $filePath = Yii::$app->basePath . '/../frontend/web/images/story/' . $fileName;

            $productPostImage = new ProductPostImages();
            $productPostImage->picture = $fileUrl;
            $productPostImage->status = 2; //quick add
            $productPostImage->createDateTime = new Expression('NOW()');
            $productPostImage->updateDateTime = new Expression('NOW()');

            if($imageFile->saveAs($filePath) && $productPostImage->save(false)) {
                $res['success'] = true;
                $res['imageId'] = Yii::$app->db->lastInsertID;
            }
        } else {
            $res['error'] = 'Can not uploaded file, please try again';
        }

        return Json::encode($res);
    }

    public function actionCurrencyCode()
    {
        $currencyInfoModels = CurrencyInfo::find()->where(['status'=>2])->orderBy(['ctry_name'=>SORT_ASC])->all();

        $res = [];
        $i = 0;

        foreach($currencyInfoModels as $currencyInfoModel) {
            $res[$i] = [
                'currencyId'=>$currencyInfoModel->currencyId,
                'name'=>$currencyInfoModel->currency_name,
                'code'=>$currencyInfoModel->currency_code,
                'symbol'=>$currencyInfoModel->currrency_symbol,
                'country'=>$currencyInfoModel->ctry_name,
            ];
            $i++;
        }

        header('Content-Type: application/json');
        return Json::encode($res);
    }
}
