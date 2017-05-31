<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;

class StoryController extends MasterController {

    public function actionIndex() {
        return $this->render('@app/themes/cozxy/layouts/story/_story');
    }

    public function actionWriteYourStory($hash) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $productSuppId = isset($params['productSuppId']) ? $params['productSuppId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;
        return $this->render('@app/themes/cozxy/layouts/story/_write_your_story');
    }

    public function actionShopDetail() {
        return $this->render('@app/themes/cozxy/layouts/story/_shop_detail');
    }

}
