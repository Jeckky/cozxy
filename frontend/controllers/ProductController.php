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

class ProductController extends \yii\web\Controller {

    public function actionIndex($hash) {
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
        $productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(4)]);
        $recentStories = new ArrayDataProvider(['allModels' => FakeFactory::productStory(20)]);
        return $this->render('index', compact('productCanSell', 'productViews', 'recentStories'));
    }

}
