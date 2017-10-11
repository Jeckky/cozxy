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

        //echo '<pre>';
        //print_r($params);
        // exit();
        $productIdParams = $params['productId']; //เก็บ ProductId
        //$productSupplierId = $params['productSupplierId'];
        if (isset($params['selectedOptions'])) {
            $selectedOptions = $params['selectedOptions'];
        } else {
            $selectedOptions = NULL;
        }
        $cartOrderId = \common\models\costfit\Order::findCartArray();
        //throw new \yii\base\Exception(print_r($cart['orderId'], true));
        $productViews = FakeFactory::productViews($productIdParams, $cartOrderId); //เทเบิล Product Suppliers หา Product ที่มีจำนวนสินค้นในสต๊อกและราคาถูกสุดออกมาแสดง
        $productSupplierId = $productViews['ProductSuppliersDetail']['productSuppId'];
        $productViews = $productViews['ProductSuppliersDetail'];



        $productId = $productIdParams; //\common\models\costfit\ProductSuppliers::productParentId($productSupplierId)->productId;
        /*
         * Product Views - Frontend
         */
        $ProductPageViews = new \common\models\costfit\ProductPageViews();
        $cookies = Yii::$app->request->cookies;
        if (isset($cookies['orderToken'])) {
            $ProductPageViews->token = $cookies['orderToken']->value;
        } else {
            $ProductPageViews->token = NULL;
        }
        $ProductPageViews->productSuppId = $productSupplierId;
        $ProductPageViews->userId = isset(Yii::$app->user->identity->userId) ? Yii::$app->user->identity->userId : '0';
        $ProductPageViews->updateDateTime = new \yii\db\Expression('NOW()');
        $ProductPageViews->createDateTime = new \yii\db\Expression('NOW()');
        $ProductPageViews->save(FALSE);
        /*
         * End Product Views
         */
        // $productViews = new ArrayDataProvider(['allModels' => FakeFactory::productViews($productSupplierId)]);
        //-- Old 16/08/2017--- $productViews = FakeFactory::productViews($productSupplierId);

        $productHotNewProduct = new ArrayDataProvider(['allModels' => FakeFactory::productHotNewAndProduct(4, FALSE)]);

        //$StoryProductPost = new ArrayDataProvider(['allModels' => DisplayMyStory::myStoryTop($productId, $productSupplierId, FALSE, FALSE)]);
        $StoryProductPost = new ArrayDataProvider(['allModels' => DisplayMyStory::myStoryTop($productIdParams, $productSupplierId, FALSE, FALSE)]);
        $productPostId = isset($StoryProductPost->allModels['myStoryTop']['productPostId']) ? $StoryProductPost->allModels['myStoryTop']['productPostId'] : '';

        //$StoryRecentStories = new ArrayDataProvider(['allModels' => DisplayMyStory::productRecentStories($productId, $productSupplierId, $productPostId), 'pagination' => ['defaultPageSize' => 5]]);
        $StoryRecentStories = new ArrayDataProvider(['allModels' => DisplayMyStory::productRecentStories($productIdParams, $productSupplierId, $productPostId), 'pagination' => ['defaultPageSize' => 5]]);
        $productGroupOptionValues = ProductGroupOptionValue::findProductOptionsArrayByProductId($productId);
        //$productGroupOptionValueSelect = ProductGroupOptionValue::find()->where('productId = ' . $productId . ' and productSuppId = ' . $productSupplierId . '')->groupBy('productId')->one();
        $productGroupOptionValueSelect = ProductGroupOptionValue::findProductGroupOptionValueSelect($productId, $productSupplierId);

        //echo '<pre>';
        //print_r($productGroupOptionValueSelect->attributes);
        return $this->render('index', compact('productGroupOptionValueSelect', 'productId', 'productSupplierId', 'productHotNewProduct', 'productViews', 'StoryProductPost', 'StoryRecentStories', 'productGroupOptionValues', 'selectedOptions'));
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

    public function actionSampleProductOption($hash = FALSE) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        //echo '<pre>';
        //print_r($params);
        //exit();
        $productIdParams = $params['productId']; //เก็บ ProductId
        //$productSupplierId = $params['productSupplierId'];
        //echo $productIdParams;
        //exit();
        if (isset($params['selectedOptions'])) {
            $selectedOptions = $params['selectedOptions'];
            // echo $selectedOptions;
            // exit();
        } else {
            $selectedOptions = NULL;
        }
        $cartOrderId = \common\models\costfit\Order::findCartArray();
        //throw new \yii\base\Exception(print_r($cart['orderId'], true));
        $productViews = FakeFactory::productViews($productIdParams, $cartOrderId); //เทเบิล Product Suppliers หา Product ที่มีจำนวนสินค้นในสต๊อกและราคาถูกสุดออกมาแสดง
        $productSupplierId = $productViews['ProductSuppliersDetail']['productSuppId'];
        $productViews = $productViews['ProductSuppliersDetail'];



        $productId = $productIdParams; //\common\models\costfit\ProductSuppliers::productParentId($productSupplierId)->productId;
        /*
         * Product Views - Frontend
         */
        $ProductPageViews = new \common\models\costfit\ProductPageViews();
        $cookies = Yii::$app->request->cookies;
        if (isset($cookies['orderToken'])) {
            $ProductPageViews->token = $cookies['orderToken']->value;
        } else {
            $ProductPageViews->token = NULL;
        }
        $ProductPageViews->productSuppId = $productSupplierId;
        $ProductPageViews->userId = isset(Yii::$app->user->identity->userId) ? Yii::$app->user->identity->userId : '0';
        $ProductPageViews->updateDateTime = new \yii\db\Expression('NOW()');
        $ProductPageViews->createDateTime = new \yii\db\Expression('NOW()');
        $ProductPageViews->save(FALSE);
        /*
         * End Product Views
         */
        // $productViews = new ArrayDataProvider(['allModels' => FakeFactory::productViews($productSupplierId)]);
        //-- Old 16/08/2017--- $productViews = FakeFactory::productViews($productSupplierId);

        $productHotNewProduct = new ArrayDataProvider(['allModels' => FakeFactory::productHotNewAndProduct(4, FALSE)]);

        //$StoryProductPost = new ArrayDataProvider(['allModels' => DisplayMyStory::myStoryTop($productId, $productSupplierId, FALSE, FALSE)]);
        $StoryProductPost = new ArrayDataProvider(['allModels' => DisplayMyStory::myStoryTop($productIdParams, $productSupplierId, FALSE, FALSE)]);
        $productPostId = isset($StoryProductPost->allModels['myStoryTop']['productPostId']) ? $StoryProductPost->allModels['myStoryTop']['productPostId'] : '';

        //$StoryRecentStories = new ArrayDataProvider(['allModels' => DisplayMyStory::productRecentStories($productId, $productSupplierId, $productPostId), 'pagination' => ['defaultPageSize' => 5]]);
        $StoryRecentStories = new ArrayDataProvider(['allModels' => DisplayMyStory::productRecentStories($productIdParams, $productSupplierId, $productPostId), 'pagination' => ['defaultPageSize' => 5]]);
        $productGroupOptionValues = ProductGroupOptionValue::findProductOptionsArrayByProductIdSp1($productId);
        //$productGroupOptionValueSelect = ProductGroupOptionValue::find()->where('productId = ' . $productId . ' and productSuppId = ' . $productSupplierId . '')->groupBy('productId')->one();
        $productGroupOptionValueSelect = ProductGroupOptionValue::findProductGroupOptionValueSelectSp1($productId, $productSupplierId);

        //echo '<pre>';
        //print_r($productGroupOptionValueSelect->attributes);
        return $this->render('sample', compact('productGroupOptionValueSelect', 'productId', 'productSupplierId', 'productHotNewProduct', 'productViews', 'StoryProductPost', 'StoryRecentStories', 'productGroupOptionValues', 'selectedOptions'));
    }

}
