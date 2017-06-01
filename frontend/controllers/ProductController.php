<?php

namespace frontend\controllers;

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
        $productId = $params['productId'];
        $productSupplierId = $params['productSupplierId'];
        /*
         * Product Views - Frontend
         */
        $productViews = new \common\models\costfit\ProductPageViews();
        $productViews->productSuppId = $productSupplierId;
        $productViews->userId = isset(Yii::$app->user->identity->userId) ? Yii::$app->user->identity->userId : '0';
        $productViews->updateDateTime = new \yii\db\Expression('NOW()');
        $productViews->createDateTime = new \yii\db\Expression('NOW()');
        $productViews->save(FALSE);

        $productViews = new ArrayDataProvider(['allModels' => FakeFactory::productViews($productSupplierId)]);


        $productHotNewProduct = new ArrayDataProvider(['allModels' => FakeFactory::productHotNewAndProduct(4, FALSE)]);
        $StoryProductPost = new ArrayDataProvider(['allModels' => DisplayMyStory::myStoryTop($productSupplierId, FALSE, FALSE)]);
        $StoryRecentStories = new ArrayDataProvider(['allModels' => DisplayMyStory::productRecentStories($productSupplierId, FALSE, FALSE)]);
        return $this->render('index', compact('productHotNewProduct', 'productViews', 'StoryProductPost', 'StoryRecentStories'));
    }

}
