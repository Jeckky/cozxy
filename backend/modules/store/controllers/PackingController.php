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

class PackingController extends StoreMasterController {

    public function beforeAction($action) {
        if ($action->id == 'ping-hardware' || $action->id == 'select-led' || $action->id == 'add-led-to-slot') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $query = \common\models\costfit\Order::find()
                ->join("LEFT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
                ->where("DATE(DATE_SUB(oi.sendDateTime,INTERVAL " . \common\models\costfit\OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() AND `order`.status = " . \common\models\costfit\Order::ORDER_STATUS_PICKED);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (isset($_GET['orderNo'])) {
            $order = \common\models\costfit\Order::find()->where("orderNo='" . $_GET['orderNo'] . "'")->one();

            $orders = new \common\models\costfit\Order();
            return $this->render('show-orders', [
                        'orderId' => $order->orderId,
            ]);
        } else {
            return $this->render('index', [
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionPacking() {
        $ms = '';
        if (isset($_GET['item'])) {
            $order = \common\models\costfit\Order::find()->where("orderId=" . $_GET['orderId'])->one();
            $productId = \common\models\costfit\Product::findProductId($_GET['item']);
            if (isset($order)) {
                if (isset($productId) && !empty($productId)) {
                    $items = \common\models\costfit\OrderItem::find()->where("orderId=" . $order->orderId . " and productId=" . $productId)->one();
                    if (isset($items) && !empty($items)) {
                        $packingItems = \common\models\costfit\OrderItemPacking::find()->where("orderItemId=" . $items->orderItemId)->one();
                        if (isset($packingItems)) {
                            $save = $this->checkSum($items->orderItemId, $items->quantity);
                            if ($save) {
                                $packingItems->quantity+=1;
                                $packingItems->updateDateTime = new \yii\db\Expression('NOW()');
                                $packingItems->save(false);
                            } else {
                                $ms = 'ไม่สามารถดำเนินการได้ เนื่องจาก สินค้าเกินจำนวนใน Order';
                            }
                        } else {
                            $packing = new \common\models\costfit\OrderItemPacking();
                            $packing->orderItemId = $items->orderItemId;
                            $packing->quantity = 1;
                            $packing->status = 99;
                            $packing->createDateTime = new \yii\db\Expression('NOW()');
                            $packing->updateDateTime = new \yii\db\Expression('NOW()');
                            $packing->save(false);
                        }
                    } else {
                        $ms = 'ไม่มี สินค้า ' . $_GET['item'] . ' ใน Order นี้';
                    }
                } else {
                    $ms = 'ไม่มี สินค้า ' . $_GET['item'] . ' ใน Order นี้';
                }
            } else {
                $ms = 'ไม่เจอ Order Id นี้';
            }
            return $this->render('show-orders', [
                        'orderId' => $order->orderId,
                        'ms' => $ms
            ]);
        }
    }

    public function actionCloseBag() {

    }

    static function checkSum($orderItemId, $orderQuantity) {
        $orderInPacks = \common\models\costfit\OrderItemPacking::find()->where("orderItemId=" . $orderItemId)->all();
        $total = 0;
        if (isset($orderInPacks) && !empty($orderInPacks)) {
            foreach ($orderInPacks as $orderInPack):
                $total+=$orderInPack->quantity;
            endforeach;
            if ($total < $orderQuantity) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
