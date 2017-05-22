<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\Store;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use common\helpers\Shipping;
use common\models\costfit\Order;
use common\models\costfit\OrderItem;
use common\models\costfit\PickingPointItems;

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
            $query = Order::find()
                    ->select('*')
                    ->joinWith(['orderItems'])
                    //->where("(order_item.status = 6 or order_item.status = 14) and order.orderNo = '" . $orderNo . "'"); //['order_item.status' => 6, 'order.orderNo' => $orderNo]
                    ->where("order_item.status = 13"); //['order_item.status' => 6, 'order.orderNo' => $orderNo]
        } else {
            $query = Order::find()
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
                /* shippingScanTrayOnly = true เข้าเงื่อนไขที่ 1 ต้อง Scan ทีละ OrderId Scan order number ถือว่าไปทุกถุง */
                /* $queryList = \common\models\costfit\Order::find()->where("orderNo = '" . $orderNo . "' ")->one();//หาorder ที่ รับ Order number มา
                  if (isset($queryList) && !empty($queryList)) {
                  if ($queryList->status == Order::ORDER_STATUS_PACKED) {//เชคถว่า สถานะเป็นแพ็คแล้วหรือยัง
                  $queryItem = \common\models\costfit\OrderItem::find()->where("orderId=" . $queryList->orderId . ' and status =13')->all(); // status : 6 pack ใส่ลงถุง
                  if (isset($queryItem) && !empty($queryItem)) {
                  foreach ($queryItem as $items) :
                  $orderItemPackings = OrderItemPacking::find()->where("orderItemId =" . $items->orderItemId . ' and status = ' . OrderItemPacking::ORDER_STATUS_CLOSE_BAG)->all(); // status 4 : ปิดถุงแล้ว
                  if (isset($orderItemPackings) && !empty($orderItemPackings)) {
                  foreach ($orderItemPackings as $packing):
                  $packing->status = OrderItemPacking::ORDER_STATUS_SENDING_PACKING_SHIPPING;
                  $packing->shipper = Yii::$app->user->identity->userId;
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
                  } */
                $queryList = Order::find()->where("orderNo = '" . $orderNo . "' ")->one(); //หาorder ที่ รับ Order number มา
                if (isset($queryList) && count($queryList) > 0) {
                    if ($queryList->status == Order::ORDER_STATUS_PACKED) {//เชคถว่า สถานะเป็นแพ็คแล้วหรือยัง
                        $queryItem = OrderItem::find()->where("orderId=" . $queryList->orderId . ' and status=' . OrderItem::ORDERITEM_STATUS_CLOSED_BAG)->all(); //status 13 ปิดถุงแล้ว พร้อมส่ง
                        if (isset($queryItem) && count($queryItem) > 0) {
                            $orderItem = OrderItem::find()->where("orderId=" . $queryList->orderId . ' and status=' . OrderItem::ORDERITEM_STATUS_CLOSED_BAG)
                                    ->orderBy("updateDateTime")
                                    ->one();
                            $pickingPoint = $orderItem->pickingId;
                            $listPoint = \common\helpers\Lockers::GetPickingPoint($pickingPoint);
                            $localNamecitie = \common\helpers\Local::Cities($listPoint->amphurId);
                            $localNamestate = \common\helpers\Local::States($listPoint->provinceId);
                            $localNamecountrie = \common\helpers\Local::Countries($listPoint->countryId);
                            $query = \common\helpers\Lockers::GetPickingPointItems($pickingPoint);
                            $dataProvider = new ActiveDataProvider([
                                'query' => $query,
                            ]);
                            $PickingPoints = [];
                            if ($listPoint->type == 1) {//ประเภทปลายทางแบบล็อคเกอร์เย็น
                                $PickingPoints['color_lid'] = '#F9BA32'; //สีเหลือง
                                $PickingPoints['frame'] = '#000000'; //โครงดำ
                                $PickingPoints['front'] = '#000000'; //ฟอนต์
                                $PickingPoints['type'] = 'lockers-hot'; //ประเภทปลายทงในการรับสินค้า
                            } else if ($listPoint->type == 2) {//ประเภทปลายทางแบบล็อคเกอร์ร้อน
                                $PickingPoints['color_lid'] = '#cccccc'; //สีเทา
                                $PickingPoints['frame'] = '#217CA3'; //โครงน้ำเงิน
                                $PickingPoints['front'] = '#000000'; //ฟอนต์
                                $PickingPoints['type'] = 'lockers-cool'; //ประเภทปลายทงในการรับสินค้า
                            } else if ($listPoint->type == 3) {//ประเภทปลายทางแบบBooth
                                $PickingPoints['color_lid'] = '#F9BA32'; //สีสีเหลือง
                                $PickingPoints['frame'] = '#000000'; //โครงดำ
                                $PickingPoints['front'] = '#000000'; //ฟอนต์
                                $PickingPoints['type'] = 'booth'; //ประเภทปลายทงในการรับสินค้า
                            }
                            $typePickingPoint = \common\models\costfit\PickingPointType::find()->where('pptId=' . $listPoint->type)->one();
                            return $this->render('locker', [
                                        'order' => $queryList,
                                        'dataProvider' => $dataProvider,
                                        'listPoint' => $listPoint,
                                        'citie' => $localNamecitie,
                                        'countrie' => $localNamecountrie,
                                        'state' => $localNamestate,
                                        'point' => $listPoint,
                                        'typePickingPoint' => $typePickingPoint,
                                        'PickingPoints' => $PickingPoints
                            ]);
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
        $orderInCars = OrderItemPacking::find()->where("shipper=" . Yii::$app->user->identity->userId . " and status=" . OrderItemPacking::ORDER_STATUS_SENDING_PACKING_SHIPPING)->all();
        $pickingPoint = $this->findPickingPoint($orderInCars);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'orderInCar' => $orderInCars,
                    'pickingPoints' => $pickingPoint,
                    'ms' => $ms
        ]);

        //return $this->render('index');
    }

    public function actionBookLocker() {
        if (isset($_GET["pickingItemsId"]) && isset($_GET["boxcode"])) {
            $ms = '';
            $pickingItemId = $_GET["pickingItemsId"];
            $pickingId = $_GET["boxcode"];
            $orderId = $_GET["orderId"];
            $pickingPoint = PickingPoint::find()->where("pickingId=" . $pickingId)->one();
            $pickingItem = PickingPointItems::find()->where("pickingItemsId=" . $pickingItemId)->one();

            if (isset($_GET["bagNo"]) && $_GET["bagNo"] != '') {
                $orderItemPackings = OrderItemPacking::find()->where("bagNo='" . $_GET["bagNo"] . "'")->all();
                if (isset($orderItemPackings) && count($orderItemPackings) > 0) {
                    foreach ($orderItemPackings as $bag):
                        $flag = false;
                        $flag = $this->checkOrder($orderId, $bag->orderItemId);
                        if ($flag == true) {
                            $bag->pickingItemsId = $pickingItemId;
                            $bag->save(false);
                        } else {
                            $ms = 'BagNo ' . $bag->bagNo . ' is not in this order.';
                        }
                    endforeach;
                } else {
                    $ms = 'This bagNo is not in this order';
                }
            }
            $orderItemPacking = OrderItemPacking::find()->where("pickingItemsId=" . $pickingItemId . " and (status=4 or status=5)")/* 5-->shipไป 1 รอบ แล้วต้องการใส่เพิ่ม */
                    ->groupBy("bagNo")
                    ->all();
            return $this->render('booking', [
                        'ms' => $ms,
                        'orderId' => $orderId,
                        'pickingItemId' => $pickingItemId,
                        'pickingId' => $pickingId,
                        'point' => $pickingPoint->title,
                        'slot' => $pickingItem->name,
                        'bagInLocker' => $orderItemPacking
            ]);
        }
    }

    public function actionRemoveFromLocker() {
        $bagNo = $_GET["bagNo"];
        $orderItemPacking = OrderItemPacking::find()->where("bagNo='" . $_GET["bagNo"] . "'")->all();
        if (isset($orderItemPacking) && count($orderItemPacking)) {
            foreach ($orderItemPacking as $bag):
                $bag->pickingItemsId = NULL;
                $bag->save(false);
            endforeach;
        }
        $this->redirect(['book-locker', 'pickingItemsId' => $_GET["pickingItemsId"],
            'boxcode' => $_GET["pickingId"],
            'orderId' => $_GET["orderId"]
        ]);
    }

    public function actionConfirmBooking() {
        $orderItemPackingId = $_GET["orderItemPackingId"];
        $pickingItemId = $_GET["pickingItemId"];
        $orderId = $_GET["orderId"];
        $pickingItem = PickingPointItems::find()->where("pickingItemsId=" . $pickingItemId)->one();
        if (isset($pickingItem)) {
            $pickingItem->status = PickingPointItems::LOCKER_NOT_EMPTY;
            $pickingItem->save(false);
        }
        $this->updateOrderItemPacking($orderItemPackingId); /* str use sql in() */
        $this->updateOrderItems($orderItemPackingId);
        $orderNo = '';
        $orderNo = $this->updateOrderBooked($orderId);
        if ($orderNo == '') {//ถ้าorderนั้น ship หมดแล้ว
            $this->redirect(['index', 'orderNo' => '']);
        } else {
            $this->redirect(['index', 'orderNo' => $orderNo,
            ]);
        }
    }

    public function updateOrderItems($orderItemPackingId) {
        $orderItemPacking = OrderItemPacking::find()->where("orderItemPackingId in ($orderItemPackingId)")->all();
        if (isset($orderItemPacking) && count($orderItemPackingId) > 0) {
            $orderItems = [];
            $i = 0;
            foreach ($orderItemPacking as $packing):
                $orderItems[$i] = $packing->orderItemId;
                $i++;
            endforeach;
            foreach ($orderItems as $item):
                $orderItemPackings = OrderItemPacking::find()->where("orderItemId=" . $item . " and status=4")->all();
                if (count($orderItemPackings) == 0) {
                    $orderItem = OrderItem::find()->where("orderItemId=" . $item)->one();
                    $orderItem->status = OrderItem::ORDER_STATUS_SENDING_SHIPPING;
                    $orderItem->updateDateTime = new \yii\db\Expression('NOW()');
                    $orderItem->save(false);
                }
            endforeach;
        }
    }

    public function updateOrderBooked($orderId) {
        $orderItems = OrderItem::find()->where("orderId=" . $orderId . " and status=" . OrderItem::ORDERITEM_STATUS_CLOSED_BAG)->all(); //หาที่ยังไม่ได้ ship
        if (count($orderItems) == 0) {//ถ้า ไม่มี orderItem ที่ยังไม่ ship
            $order = Order::find()->where("orderId=" . $orderId)->one();
            $order->status = Order::ORDER_STATUS_SENDING_SHIPPING;
            $order->updateDateTime = new \yii\db\Expression('NOW()');
            $order->save(false);
            return '';
        } else {
            $order = Order::find()->where("orderId=" . $orderId)->one();
            return $order->orderNo;
        }
    }

    public function updateOrderItemPacking($orderItemPackingId) {
        $orderItemPacking = OrderItemPacking::find()->where("orderItemPackingId in ($orderItemPackingId)")->all();
        if (isset($orderItemPacking) && count($orderItemPackingId) > 0) {
            foreach ($orderItemPacking as $packing):
                $packing->status = OrderItemPacking::ORDER_STATUS_SENDING_PACKING_SHIPPING;
                $packing->shipper = Yii::$app->user->identity->userId;
                $packing->save(FALSE);
            endforeach;
        }
    }

    public function checkOrder($orderId, $orderItemId) {
        $orderItem = OrderItem::find()->where("orderId=" . $orderId . " and orderItemId=" . $orderItemId)->one();
        if (isset($orderItem)) {
            return true;
        } else {
            return false;
        }
    }

    public function actionScanbag() {
        $ms = '';
        $items = '';
        $orderNo = Yii::$app->request->get('orderNo');
        $order = Order::find()->where("orderNo='" . $orderNo . "'")->one();
        if (isset($order) && !empty($order)) {
            if ($order->status == Order::ORDER_STATUS_PACKED) {
                $orderItems = OrderItem::find()->where("orderId=" . $order->orderId)->all();
                if (isset($orderItems) && !empty($orderItems)) {
                    foreach ($orderItems as $item):
                        $items = $item->orderItemId . ",";
                    endforeach;
                    $items = substr($items, 0, -1);
                    // $query = OrderItemPacking::find()->where("orderItemId in ($items) and status=4");
                }else {
                    $ms = 'ไม่พบสินค้าในออเดอร์นี้';
                }
            } else if ($order->status == Order::ORDER_STATUS_SENDING_SHIPPING) {
                $ms = 'Order นี้ สแกนแล้ว'; //ไม่เจอ order กลับไปหน้า index
                $query = Order::find()
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
            $query = Order::find()
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
            $orderItem = OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
            if (isset($orderItem) && !empty($orderItem)) {
                $orderItem->status = OrderItem::ORDER_STATUS_SENDING_SHIPPING;
                $orderItem->updateDateTime = new \yii\db\Expression('NOW()');
                $orderItem->save(false);
            }
        }
    }

    static public function updateOrder($orderNo) {
        $order = Order::find()->where("orderNo='" . $orderNo . "'")->one();
        $orderItem = 0;
        if (isset($order) && !empty($order)) {
            $orderItem = count(OrderItem::find()->where("orderId=" . $order->orderId . " and status=" . Order::ORDER_STATUS_PACKED)->all());
            if ($orderItem == 0) {
                $order->status = OrderItem::ORDER_STATUS_SENDING_SHIPPING;
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

    public static function findPickingPoint($incars) {
        $pickingPoint = [];
        $i = 0;
        if (isset($incars) && !empty($incars)) {
            foreach ($incars as $incar):
                $check = 0;
                $order = OrderItem::find()->where("orderItemId=" . $incar->orderItemId)->one();
                $point = Order::find()->where("orderId=" . $order->orderId)->one();
                foreach ($pickingPoint as $old):
                    if ($old == $point->pickingId) {
                        $check++;
                    }
                endforeach;
                if ($check == 0) {
                    $pickingPoint[$i] = $point->pickingId;
                    $i++;
                }
            endforeach;
        }
        return $pickingPoint;
    }

}
