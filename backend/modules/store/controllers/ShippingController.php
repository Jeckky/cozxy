<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\Store;
use common\models\costfit\Order;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

// อยู่ที่ไหน ช่องไหน : หยิบโปรดักจากสโตร์ไป Picking ponit
class ShippingController extends StoreMasterController {
    /*
      return Foo::find()->joinWith('bars')
      ->leftJoin('tbl_bar_subscription', 'tbl_bar_subscription.bar_id = bar.id')
      ->where(['tbl_bar_subscription.client_id' => $this->id])
      ->distinct();
     */

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
        //'params : ' . \Yii::$app->params['shippingScanTrayOnly']; // มีค่าเท่ากับเริ่มต้น true
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        if (!isset(Yii::$app->user->identity->userId)) {
            return $this->redirect($baseUrl . '/auth');
        }
        $ms = '';
        $orderNo = Yii::$app->request->get('orderNo');
        if ($orderNo != '') {
            $query = \common\models\costfit\Order::find()
                    ->select('*')
                    ->joinWith(['orderItems'])
                    //->where("(order_item.status = 6 or order_item.status = 14) and order.orderNo = '" . $orderNo . "'"); //['order_item.status' => 6, 'order.orderNo' => $orderNo]
                    ->where("order_item.status = 13"); //['order_item.status' => 6, 'order.orderNo' => $orderNo]
        } else {
            $query = \common\models\costfit\Order::find()
                    //->select("`order`.*,oi.*")
                    //->join("RIGHT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
                    //->where("oi.status = 6 OR oi.status = 14");
                    ->select('*')
                    ->joinWith(['orderItems'])
                    ->where("order_item.status = 13");
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //throw new \yii\base\Exception($dataProvider->getTotalCount());


        if ($orderNo != '') {
            if (\Yii::$app->params['shippingScanTrayOnly'] == true) {
                /* shippingScanTrayOnly = true เข้าเงื่อนไขที่ 1 ต้อง Scan ทีละ OrderId */
                $queryList = \common\models\costfit\Order::find()->where("orderNo = '" . $orderNo . "' ")->one();
                if (isset($queryList) && !empty($queryList)) {
                    if ($queryList->status == 13) {
                        $queryItem = \common\models\costfit\OrderItem::find()->where("orderId=" . $queryList->orderId . ' and status =13')->all(); // status : 6 pack ใส่ลงถุง
                        if (isset($queryItem) && !empty($queryItem)) {
                            foreach ($queryItem as $items) :
                                $orderItemPackings = OrderItemPacking::find()->where("orderItemId =" . $items->orderItemId . ' and status = ' . OrderItemPacking::ORDER_STATUS_CLOSE_BAG)->all(); // status 4 : ปิดถุงแล้ว
                                if (isset($orderItemPackings) && !empty($orderItemPackings)) {
                                    foreach ($orderItemPackings as $packing):
                                        $packing->status = OrderItemPacking::ORDER_STATUS_SENDING_PACKING_SHIPPING;
                                        $packing->save(FALSE);
                                        $queryItemStatus = \common\models\costfit\OrderItem::find()->where("orderItemId=" . $packing->orderItemId . ' and status = 13')->all();
                                        foreach ($queryItemStatus as $shipStatus) :
                                            $shipStatus->status = \common\models\costfit\OrderItem::ORDER_STATUS_SENDING_SHIPPING; // orderItemId : status = 14
                                            $shipStatus->save();
                                            $queryList->status = \common\models\costfit\Order::ORDER_STATUS_SENDING_SHIPPING; // orderId : status = 14
                                            $queryList->save();
                                        endforeach;
                                    endforeach;
                                }else {
                                    $ms = 'ไม่มีสินค้าพร้อมส่ง';
                                }
                            endforeach;
                        } else {
                            $ms = 'ไม่มีสินค้าที่แพ็คแล้ว หรือ พร้อมส่ง';
                        }
                    } else {
                        $ms = 'Order นี้ สแกนแล้ว';
                    }
                } else {
                    $ms = 'ไม่พบออเดอร์';
                }
            } else {
                /* shippingScanTrayOnly = false เข้าเงื่อนไขที่ 2 ต้อง Scan ทีละถุง */
            }
            //$this->redirect(Yii::$app->homeUrl . 'store/shipping/');
        }

        //print_r($query);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'ms' => $ms
        ]);

        //return $this->render('index');
    }

    public function actionScanbag() {
        $ms = '';
        $items = '';
        $orderNo = Yii::$app->request->get('orderNo');
        $order = Order::find()->where("orderNo='" . $orderNo . "'")->one();
        if (isset($order) && !empty($order)) {
            if ($order->status == 13) {
                $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $order->orderId)->all();
                if (isset($orderItems) && !empty($orderItems)) {
                    foreach ($orderItems as $item):
                        $items = $item->orderItemId . ",";
                    endforeach;
                    $items = substr($items, 0, -1);
                    // $query = OrderItemPacking::find()->where("orderItemId in ($items) and status=4");
                }else {
                    $ms = 'ไม่พบสินค้าในออเดอร์นี้';
                }
            } else if ($order->status == 14) {
                $ms = 'Order นี้ สแกนแล้ว'; //ไม่เจอ order กลับไปหน้า index
                $query = \common\models\costfit\Order::find()
                        ->select('*')
                        ->joinWith(['orderItems'])
                        ->where("order_item.status = 13");
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,]);
                return $this->render('index', [
                            'dataProvider' => $dataProvider,
                            'ms' => $ms]);
            }
        } else {
            $ms = 'ไม่พบออเดอร์นี้'; //ไม่เจอ order กลับไปหน้า index
            $query = \common\models\costfit\Order::find()
                    ->select('*')
                    ->joinWith(['orderItems'])
                    ->where("order_item.status = 13");
            $dataProvider = new ActiveDataProvider([
                'query' => $query,]);
            return $this->render('index', [
                        'dataProvider' => $dataProvider,
                        'ms' => $ms]);
        }
        $flag = false;
        if (isset($_GET['bagNo']) && !empty($_GET['bagNo'])) {
            $inPackings = OrderItemPacking::find()->where("bagNo='" . $_GET['bagNo'] . "'")->all();
            if (isset($inPackings) && !empty($inPackings)) {
                foreach ($inPackings as $inPacking):
                    $inPacking->status = 5;
                    $inPacking->updateDateTime = new \yii\db\Expression('NOW()');
                    $inPacking->save(false);
                    $this->updateOrderItem($inPacking->orderItemId);
                    $flag = $this->updateOrder($_GET['orderNo']);
                endforeach;
            } else {
                $ms = 'ไม่มีถุงนี้ในระบบ กรุณาลองใหม่อีกครั้ง';
            }
        } else {
            $ms = '';
        }
        if ($items != '') {
            $query = OrderItemPacking::find()->where("orderItemId in ($items) and (status=4 or status=5)");
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if ($flag == true) {
            $this->redirect('view');
        } else {
            return $this->render('scanbag', [
                        'dataProvider' => $dataProvider,
                        'orderNo' => $orderNo,
                        'ms' => $ms
            ]);
        }
    }

    public function actionView() {
        return $this->render('view');
    }

    static public function updateOrderItem($orderItemId) {
        $ItemInPacking = 0;
        $ItemInPacking = count(OrderItemPacking::find()->where("orderItemId=" . $orderItemId . " and status=4")->all());
        if ($ItemInPacking == 0) {
            $orderItem = \common\models\costfit\OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
            if (isset($orderItem) && !empty($orderItem)) {
                $orderItem->status = 14;
                $orderItem->updateDateTime = new \yii\db\Expression('NOW()');
                $orderItem->save(false);
            }
        }
    }

    static public function updateOrder($orderNo) {
        $order = Order::find()->where("orderNo='" . $orderNo . "'")->one();
        $orderItem = 0;
        if (isset($order) && !empty($order)) {
            $orderItem = count(\common\models\costfit\OrderItem::find()->where("orderId=" . $order->orderId . " and status=13")->all());
            if ($orderItem == 0) {
                $order->status = 14;
                $order->updateDateTime = new \yii\db\Expression('NOW()');
                $order->save();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
