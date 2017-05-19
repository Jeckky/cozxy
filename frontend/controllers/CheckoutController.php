<?php

namespace frontend\controllers;

class CheckoutController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSummary()
    {
        return $this->render('summary');
    }

}
