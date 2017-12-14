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

/**
 * Default controller for the `mobile` module
 */
class QuickAddController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionSave()
    {
        $res = ['success' => false, 'error' => NULL];
        $productId = $_POST['productId'];
        $memo = $_POST['memo'];
        $price = $_POST['price'];
        $nameOfPlace = $_POST['nameOfPlace'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $currency = $_POST['currency'];
        $country = $_POST['country'];
        $imageIds = $_POST['imageIds'];
        $userId = isset(Yii::$app->user->id) ? Yii::$app->user->id : 43;

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

            //create ProductPostPrice
            $productPostComparePriceModel = new ProductPostComparePrice();
            $productPostComparePriceModel->productId = $productId;
            $productPostComparePriceModel->productPostId = $storyId;
            $productPostComparePriceModel->userId = $userId;
            $productPostComparePriceModel->latitude = $latitude;
            $productPostComparePriceModel->longitude = $longitude;
            $productPostComparePriceModel->shopName = $nameOfPlace;
            $productPostComparePriceModel->price = $price;
            $productPostComparePriceModel->createDateTime = $productPostComparePriceModel->updateDateTime = new Expression('NOW()');
            $productPostComparePriceModel->status = 2;
            $productPostComparePriceModel->currency = $currency;
            $productPostComparePriceModel->country = $country;

            if($productPostComparePriceModel->save()) {
                $numRows = ProductPostImages::updateAll(['productPostId'=>$storyId], 'imagesId in ('.implode(',', $imageIds).')');

                if($numRows == sizeof($imageIds)) {
                    $flag = true;
                }
            }

            if($flag) {
                $transaction->commit();
                $res['success'] = true;
            } else {
                $transaction->rollBack();
                $res['error'] = 'Error :: Please try again';
            }
        }
        catch(Exception $e) {
            $transaction->rollBack();
            $res['error'] = $storyModel->errors;
        }
        return Json::encode($res);
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
}
