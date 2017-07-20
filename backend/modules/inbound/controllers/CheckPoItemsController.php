<?php

namespace backend\modules\inbound\controllers;

use Yii;
use common\models\costfit\ProductPost;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

class CheckPoItemsController extends InboundMasterController {

    public function actionIndex() {

        $poQrcode = Yii::$app->request->post('poQrcode');
        if (isset($poQrcode) && !empty($poQrcode)) {
            $poContent = new ArrayDataProvider(['allModels' => \common\helpers\Inbound::CheckPo($poQrcode)]);
            $poItems = new ArrayDataProvider(['allModels' => \common\helpers\Inbound::CheckPoItems($poQrcode)]);

            return $this->render('items/po-items', compact('poContent', 'poItems'));
        } else {
            return $this->render('index');
        }
    }

    public function actionQuickImport() {
        return $this->render('quick-import');
    }

}
