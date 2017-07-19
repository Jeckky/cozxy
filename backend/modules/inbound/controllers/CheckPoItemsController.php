<?php

namespace backend\modules\inbound\controllers;

use Yii;
use common\models\costfit\ProductPost;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CheckPoItemsController extends InboundMasterController {

    public function actionIndex() {
        return $this->render('index');
    }

}
