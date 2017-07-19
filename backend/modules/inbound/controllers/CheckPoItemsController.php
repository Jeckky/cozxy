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
        $poQrcode = Yii::$app->request->post('poQrcode');
        if (isset($poQrcode) && !empty($poQrcode)) {

            return $this->render('items/po-items');
        } else {
            return $this->render('index');
        }
    }

}
