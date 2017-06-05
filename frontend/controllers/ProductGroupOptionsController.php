<?php

namespace frontend\controllers;

use common\models\costfit\ProductGroupOptionValue;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use frontend\models\FakeFactory;
use frontend\models\DisplayMyStory;

class ProductGroupOptionsController extends MasterController {

    public function actionIndex($hash = FALSE) {

    }

    public function actionProductByOptions($hash=false)
    {
        $p = $_POST;

        $res['token'] = 'V52KtMKZH6QnTcEpBD8CkveC4ijwm79CGY5WuLgzOk2eski54li1GgzDKqd_hRX6';

        echo Json::encode($res);
    }

}
