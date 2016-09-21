<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\Store;
use common\models\costfit\LedItem;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class PackingController extends StoreMasterController
{

    public function beforeAction($action)
    {
        if ($action->id == 'ping-hardware' || $action->id == 'select-led' || $action->id == 'add-led-to-slot') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $query = \common\models\costfit\Order::find()
        ->join("LEFT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
        ->where("DATE(DATE_SUB(oi.sendDateTime,INTERVAL " . \common\models\costfit\OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() AND `order`.status = " . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
