<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\Brand;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;
//use common\helpers\Po;
use common\models\costfit\Po;

/**
 * BrandController implements the CRUD actions for Brand model.
 */
class PoController extends SuppliersMasterController {

    public function behaviors() {
        return [
        ];
    }

    /**
     * Lists all Brand models.
     * @return mixed
     */
    public function actionIndex() {
        $tokenUserId = Yii::$app->user->identity->userId;
        //$Po = Po::PoSuppliers($tokenUserId);
        $Po = Po::find()->where("supplierIdx=" . $tokenUserId)->orderBy('updateDateTime')->all();
        /*
          $poSuppliers = [];
          foreach ($Po as $value) {
          $poSuppliers['orderId'] = $value['orderId'];
          $poSuppliers['orderNo'] = $value['orderNo'];
          $poSuppliers['invoiceNo'] = $value['invoiceNo'];
          }
         */
        return $this->render('index', [
                    'Po' => $Po,
        ]);
    }

}
