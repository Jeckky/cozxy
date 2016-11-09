<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\Store;
use common\models\costfit\Order;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use common\models\costfit\PickingPointItems;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class LockersController extends StoreMasterController {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

    public function actionIndex() {

        $orderItemId = Yii::$app->request->get('orderItemId');
        $orderId = Yii::$app->request->get('orderId');
        $bagNo = Yii::$app->request->get('bagNo');
        if ($orderId != '') {
            $query = \common\models\costfit\OrderItemPacking::find()
            ->select('*,order_item_packing.bagNo,order_item_packing.status,order_item_packing.quantity')
            ->joinWith(['orderItems'])
            ->where(['order_item.orderId' => $orderId])
            ->andWhere(['>', 'order_item_packing.status', 4]);
        } else if ($bagNo != '') {
            $query = \common\models\costfit\OrderItemPacking::find()
            ->select('*')
            ->joinWith(['orderItems'])
            ->where(['order_item.orderId' => $orderId])
            ->where(['order_item_packing.status' => 5, 'order_item_packing.bagNo' => $bagNo]);
        }
        //print_r($query);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider, 'bagNo' => $bagNo
        ]);
    }

    public function actionBagnoLockers() {

        $bagNo = Yii::$app->request->get('bagNo');
        $lockersNo = Yii::$app->request->get('lockers');

        if ($lockersNo != '') {
            $query = \common\models\costfit\PickingPointItems::find()
            //->joinWith(['orderItems'])
            ->where(['code' => $lockersNo])->one();
            //echo '<pre>';
            //print_r($query);
            if (count($query) > 0) {
                //echo 'มีรหัส lockers No นี้';
                $lockersCode = TRUE;
                //echo $query->pickingItemsId;
                $useSlot = \common\models\costfit\OrderItemPacking::find()->where(" pickingItemsId = " . $query->pickingItemsId . " and status = 7")->one(); //มีใช้แล้วหรือเปล่า
                if (!isset($useSlot)) {

                    $OrderItemPacking = \common\models\costfit\OrderItemPacking::find()->where(" bagNo = '" . $bagNo . "'")->one();

                    $OrderItems = \common\models\costfit\OrderItemPacking::find()->where(" orderItemId = '" . $OrderItemPacking->orderItemId . "' and status = 5")->count();

                    if ($OrderItems > 1) {
                        \common\models\costfit\OrderItemPacking::updateAll(['status' => 7, 'pickingItemsId' => $query->pickingItemsId], ['bagNo' => $bagNo]);
                        //echo '<pre>';
                        //print_r($OrderItemPacking);

                        \common\models\costfit\OrderItem::updateAll(['status' => 14], ['orderItemId' => $OrderItemPacking->orderItemId]);
                        $Order = \common\models\costfit\OrderItem::find()->where("orderItemId = '" . $OrderItemPacking->orderItemId . "' ")->one();
                        \common\models\costfit\Order::updateAll(['status' => 14], ['orderId' => $Order->orderId]);
                    } elseif ($OrderItems == 1) {

                        \common\models\costfit\OrderItemPacking::updateAll(['status' => 7, 'pickingItemsId' => $query->pickingItemsId], ['bagNo' => $bagNo]);
                        //echo '<pre>';
                        //print_r($OrderItemPacking);

                        \common\models\costfit\OrderItem::updateAll(['status' => 15], ['orderItemId' => $OrderItemPacking->orderItemId]);
                        $Order = \common\models\costfit\OrderItem::find()->where("orderItemId = '" . $OrderItemPacking->orderItemId . "' ")->one();
                        \common\models\costfit\Order::updateAll(['status' => 15], ['orderId' => $Order->orderId]);
                    }
                    //$orderItemId = $OrderItemPacking->orderItemId;
                } else {
                    echo 'xx';
                }

                $query = \common\models\costfit\OrderItemPacking::find()
                ->select('*')
                //->joinWith(['orderItems'])
                ->where(['bagNo' => $bagNo]);
                $this->redirect(Yii::$app->homeUrl . 'store/shipping');
            } else {
                //echo 'ไม่พบ lockers No นี';
                $lockersCode = FALSE;
                $query = \common\models\costfit\OrderItemPacking::find()
                ->select('*')
                //->joinWith(['orderItems'])
                ->where(['bagNo' => $bagNo]);
            }
        } else {
            $query = \common\models\costfit\OrderItemPacking::find()
            ->select('*')
            //->joinWith(['orderItems'])
            ->where(['bagNo' => $bagNo]);
        }
        // echo '<pre>';
        //print_r($query);
        //exit();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('lockers', [ 'dataProvider' => $dataProvider, 'bagNo' => $bagNo]);
    }

}
