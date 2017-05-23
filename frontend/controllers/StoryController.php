<?php

namespace frontend\controllers;

class StoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@app/themes/cozxy/layouts/story/_story');
    }

}
