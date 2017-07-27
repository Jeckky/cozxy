<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use frontend\models\DisplayMyStory;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Product;
use common\models\costfit\ProductImageSuppliers;
use common\models\costfit\ProductShelf;
use common\models\costfit\Currency;
use common\models\dbworld\Countries;

class ContentController extends MasterController {

    public function actionIndex($hash = FALSE) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        /*
         * Product Post View : Count Story
         */
        $productViews = new \common\models\costfit\ProductPostView();
        $productViews->productPostId = $params['productPostId'];
        $productViews->userId = isset(Yii::$app->user->identity->userId) ? Yii::$app->user->identity->userId : NULL;
        $cookies = Yii::$app->request->cookies;
        if (isset($cookies['orderToken'])) {
            $productViews->token = $cookies['orderToken']->value;
        } else {
            $productViews->token = NULL;
        }
        $productViews->updateDateTime = new \yii\db\Expression('NOW()');
        $productViews->createDateTime = new \yii\db\Expression('NOW()');
        $productViews->save(FALSE);
        $content = \common\models\costfit\ProductPost::find()->where('productPostId=' . $params['productPostId'] . ' and status =1')->one();
        return $this->render('@app/themes/cozxy/layouts/content/_content', compact('content'));
    }

}
