<?php

namespace frontend\controllers;

class ContentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@app/themes/cozxy/layouts/content/_content');
    }

}
