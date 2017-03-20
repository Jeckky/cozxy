<?php

namespace backend\modules\controllers;

class BoothController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
