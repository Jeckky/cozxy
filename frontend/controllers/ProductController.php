<?php

namespace frontend\controllers;

use common\models\costfit\ProductGroupOptionValue;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use frontend\models\FakeFactory;
use frontend\models\DisplayMyStory;

class ProductController extends MasterController {

    public function actionIndex($hash = FALSE) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        //$productId = $params['productId'];
        $productSupplierId = $params['productSupplierId'];
        if (isset($params['selectedOptions'])) {
            $selectedOptions = $params['selectedOptions'];
        } else {
            $selectedOptions = NULL;
        }
        $productId = \common\models\costfit\ProductSuppliers::productParentId($productSupplierId)->productId;
        /*
         * Product Views - Frontend
         */
        $productViews = new \common\models\costfit\ProductPageViews();
        $cookies = Yii::$app->request->cookies;
        if (isset($cookies['orderToken'])) {
            $productViews->token = $cookies['orderToken']->value;
        } else {
            $productViews->token = NULL;
        }
        $productViews->productSuppId = $productSupplierId;
        $productViews->userId = isset(Yii::$app->user->identity->userId) ? Yii::$app->user->identity->userId : '0';
        $productViews->updateDateTime = new \yii\db\Expression('NOW()');
        $productViews->createDateTime = new \yii\db\Expression('NOW()');
        $productViews->save(FALSE);

        // $productViews = new ArrayDataProvider(['allModels' => FakeFactory::productViews($productSupplierId)]);
        $productViews = FakeFactory::productViews($productSupplierId);
        $productViews = $productViews[$productSupplierId];

        $productHotNewProduct = new ArrayDataProvider(['allModels' => FakeFactory::productHotNewAndProduct(4, FALSE)]);

        $StoryProductPost = new ArrayDataProvider(['allModels' => DisplayMyStory::myStoryTop($productId, $productSupplierId, FALSE, FALSE)]);
        $productPostId = isset($StoryProductPost->allModels['myStoryTop']['productPostId']) ? $StoryProductPost->allModels['myStoryTop']['productPostId'] : '';

        $StoryRecentStories = new ArrayDataProvider(['allModels' => DisplayMyStory::productRecentStories($productId, $productSupplierId, $productPostId), 'pagination' => ['defaultPageSize' => 5]]);
        $productGroupOptionValues = ProductGroupOptionValue::findProductOptionsArray($productSupplierId);
        return $this->render('index', compact('productId', 'productSupplierId', 'productHotNewProduct', 'productViews', 'StoryProductPost', 'StoryRecentStories', 'productGroupOptionValues', 'selectedOptions'));
    }

    public function actionImagesItemBig() {
        $ImageId = $_POST['ImageId'];
        $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl;
        //$getImage = \common\models\costfit\ProductImage::find()->where('productImageId=' . $ImageId)->one();
        //if (!isset($getImage) > 0) {
        $getImage = \common\models\costfit\ProductImageSuppliers::find()->where('productImageId=' . $ImageId)->one();
        //}
        if (count($getImage) > 0) {
            if (isset($getImage->image) && !empty($getImage->image)) {
                if (file_exists(Yii::$app->basePath . "/web/" . $getImage->image)) {
                    $productImagesThumbnail1 = $url . $getImage->image;
                } else {
                    $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg('Svg555x340');
                }
            } else {
                $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg('Svg555x340');
            }
        } else {
            $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg('Svg555x340');
        }
        return $productImagesThumbnail1;
    }

}
