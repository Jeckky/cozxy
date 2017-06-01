<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use frontend\models\DisplayMyStory;

class StoryController extends MasterController {

    public function actionIndex($hash = FALSE) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $productSuppId = isset($params['productSuppId']) ? $params['productSuppId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;
        $ViewsRecentStories = DisplayMyStory::productViewsRecentStories($productPostId);


        return $this->render('@app/themes/cozxy/layouts/story/_story', compact('ViewsRecentStories'));
    }

    public function actionWriteYourStory($hash) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $productSuppId = isset($params['productSuppId']) ? $params['productSuppId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;

        return $this->render('@app/themes/cozxy/layouts/story/_write_your_story');
    }

    public function actionShopDetail() {
        return $this->render('@app/themes/cozxy/layouts/story/_shop_detail');
    }

}
