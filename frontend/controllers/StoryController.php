<?php

namespace frontend\controllers;

class StoryController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('@app/themes/cozxy/layouts/story/_story');
    }

    public function actionWriteYourStory() {
        return $this->render('@app/themes/cozxy/layouts/story/_write_your_story');
    }

    public function actionShopDetail() {
        return $this->render('@app/themes/cozxy/layouts/story/_shop_detail');
    }

}
