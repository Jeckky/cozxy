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
use common\models\costfit\StorePicking;
use common\models\costfit\Order;
use common\models\costfit\OrderItem;
use kartik\mpdf\Pdf;

class PickingController extends StoreMasterController {

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

    public function beforeAction($action) {
        if ($action->id == 'ping-hardware' || $action->id == 'select-led' || $action->id == 'add-led-to-slot') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $alert = '';
        if (!isset(Yii::$app->user->identity->userId)) {
            return $this->redirect($baseUrl . '/auth');
        }
        if (isset($_GET['alert'])) {
            $alert = $_GET['alert'];
        }
        $userId = Yii::$app->user->identity->userId;
        $oldUser = $this->checkOldPicker($userId); // ถ้าเป็นคนหยิบของที่หยิบของในออเดอร์ที่เลือกมายังไม่เสร็จ บังคับให้กลับบมาหน้าหยิบให้เสร็จ

        $findEnough = Order::find()
                        ->join("LEFT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
                        ->where("DATE(DATE_SUB(oi.sendDateTime,INTERVAL " . OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() AND `order`.status >= " . Order::ORDER_STATUS_CREATEPO . " and oi.status=1 and oi.productSuppId!=''")->all();

        $allId = [];
        $e = 0;
        if (isset($findEnough)):
            foreach ($findEnough as $enoughOrderId)://หา orderId ทั้งหมด ที่พร้อมส่ง ก่อนที่จะเชคว่ามีพอหรือปล่าว
                $allId[$e] = $enoughOrderId->orderId;
                $e++;
            endforeach;
        endif;
        //throw new \yii\base\Exception(print_r($allId, true));
        $enoughId = $this->checkQuantity($allId); //ได้ orderId ที่มีของพอ
        //throw new \yii\base\Exception($enoughId);
        if ($enoughId != '') {
            $query = Order::find()
                    ->join("LEFT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
                    ->where("DATE(DATE_SUB(oi.sendDateTime,INTERVAL " . OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() AND `order`.status >= " . Order::ORDER_STATUS_CREATEPO . " and order.orderId in(" . $enoughId . ") and oi.status=1  and oi.productSuppId!='' order by oi.sendDateTime")
                    ->limit('order', 6);
            $select = Order::find()
                    ->join("LEFT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
                    ->where("DATE(DATE_SUB(oi.sendDateTime,INTERVAL " . OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() AND `order`.status >= " . Order::ORDER_STATUS_CREATEPO . " and order.orderId in(" . $enoughId . ") and oi.status=1 and oi.productSuppId!=''")
                    ->limit('order', 6)
                    ->all();
        } else {//ถ้า มีของใน order ไม่ครบ
            $query = Order::find()
                    ->where("orderId = 0");
            $select = Order::find()
                            ->where("orderId = 0")->all();
        }
        //throw new \yii\base\Exception(print_r($select, true));
        //throw new \yii\base\Exception(count($select));
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $allOrderId = '';
        if (isset($_GET["selection"])) {//checkbox return มาเป็น orderId
            $allOrderId = $_GET["selection"];
            $check = $this->checkVariableOrder($allOrderId); // check ว่า order ที่เลือกมามีคนหยิบไปแล้วหรือยัง ถ้ามีคนหยิบไปแล้ว(return false) กลับไปหน้าเลือกorderใหม่
            if ($check == FALSE) {
                $alert = 'false';
                // throw new \yii\base\Exception('1234');
                // return $this->redirect($baseUrl . '/store/picking?alert=' . $alert);
//                return $this->render('index', [
//                            'dataProvider' => $dataProvider,
//                            'selects' => $select,
//                            'alert' => $alert
//                ]);
            }
            $slots = [];
            $i = 0;
            $this->saveSelection($allOrderId, $userId); //บันทึกใครหยิบ ออร์เดอร์ไหนบ้าง
            foreach ($allOrderId as $orderId):
                $items = OrderItem::find()->where("orderId = " . $orderId . " and status in (1,4,5) and DATE(DATE_SUB(sendDateTime, INTERVAL " . OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE()")->all();
                if (isset($items) && !empty($items)) {
                    //throw new \yii\base\Exception('0000');
                    foreach ($items as $item):
                        $flag = false;
                        if (isset($_GET['qrSlot'])) {//ถ้ามีการ ค้นหาด้วย qrcode
                            if ($_GET['qrSlot'] == '') {
                                return $this->redirect($baseUrl . '/store/picking');
                            }
                            $storeSlot = \common\models\costfit\StoreSlot::find()->where("barcode = '" . $_GET['qrSlot'] . "'")->one();
                            if (isset($storeSlot)) {
                                $slots[0] = $storeSlot->storeSlotId;
                            } else {
                                $slots[0] = 'a';
                            }
                        } else {
                            $result = $item->quantity;

                            // $slot = \common\models\costfit\StoreProductArrange::find()->where("productId = " . $item->productId . " and status = 4 and result!=0 order by createDateTime")->all(); //หา slot ทั้งหมดที่ product วางอยู่ และ ไม่เท่ากับ 0
                            $slot = \common\models\costfit\StoreProductArrange::find()->where("productSuppId = " . $item->productSuppId . " and status = 4 and result!=0 order by createDateTime")->all(); //หา slot ทั้งหมดที่ product วางอยู่ และ ไม่เท่ากับ 0
                            if (isset($slot) && !empty($slot)) {
                                // throw new \yii\base\Exception('34325');
//throw new \yii\base\Exception(print_r($slot, true));
                                foreach ($slot as $eSlot):
                                    $enoughItemInSlot = false;
                                    $flag = false;
                                    //$enoughItemInSlot = $this->checkEnoughItemInSlot($eSlot->slotId, $item->productId, $result); //เชคว่าในสล็อตนั้นมีของครบเปล่า/ถ้าครบ เบรค ไปโปรดักถัดไป
                                    $enoughItemInSlot = $this->checkEnoughItemInSlot($eSlot->slotId, $item->productSuppId, $result); //เชคว่าในสล็อตนั้นมีของครบเปล่า/ถ้าครบ เบรค ไปโปรดักถัดไป
                                    $flag = $this->checkSlot($slots, $eSlot->slotId); //check ว่า เป็น slot  เดียวกันมั๊ย ถ้า slot  เดียวกันเอาแค่ อันเดียว
                                    if ($flag) {

                                        $slots[$i] = $eSlot->slotId;
                                        $i++;
                                    }
                                    if ($enoughItemInSlot == true) {
                                        //$this->updateSlot($eSlot->slotId, $item->productId, $result, $item->orderId);
                                        $this->updateSlot($eSlot->slotId, $item->productSuppId, $result, $item->orderId);
                                        $orderItemCheck = OrderItem::find()->where("orderId = " . $orderId . " and orderItemId = " . $item->orderItemId)->one();
                                        if ($orderItemCheck->status == 4) {
                                            break;
                                        }
                                        $result = $result - $eSlot->result;
                                    } else {
                                        $pick = $result;
                                        $result = $result - $eSlot->result;
                                        //$this->updateSlot($eSlot->slotId, $item->productId, $pick, $item->orderId);
                                        $this->updateSlot($eSlot->slotId, $item->productSuppId, $pick, $item->orderId);
                                    }
                                endforeach;
                            } else {
                                $ms = 'products not found in store!'; //ถ้าไม่มีสิ้นค้าใน store
                            }
                        }
                    endforeach;
                }
            endforeach;
            if ($slots[0] != '') {
                $allSlot = new \common\models\costfit\StoreSlot(); //หา slot
                if ($slots[0] == 'a') {
                    $color = '';
                } else {
                    $old = $this->checkOldUser($allOrderId); //ถ้ายังทำรายการไม่เสร็จ ยังไม่เปลี่ยนหรือ ปิดไฟ//หรือ กด refresh
                    if ($old == 'no') {
                        //$slots = ['4', '6'];
                        $colors = \common\models\costfit\Led::variableColor($allSlot->getSlotName($slots[0]));
                        //throw new \yii\base\Exception(print_r($colors, true));
                        $this->turnOnLedSlot($slots, $colors->ledColor, $allOrderId);
                        $stringSlots = '';
                        foreach ($slots as $str):
                            $slotName = \common\models\costfit\StoreSlot::find()->where("storeSlotId=" . $str)->one();
                            $stringSlots = $stringSlots . "'" . $slotName->barcode . "'" . ",";
                            // $stringSlots = $stringSlots . $slotName->barcode . ",";
                        endforeach;
                        $stringSlots = substr($stringSlots, 0, -1);
                        //$stringSlots = "'R1C1S2'";
                        //throw new \yii\base\Exception($stringSlots);
                        //Yii::$app->runAction('led/led/open-led', ['slot' => $stringSlots, 'colorId' => $colors->ledColor]);
                    } else {
                        $colors = \common\models\costfit\LedColor::find()->where("ledColor = " . $old)->one();
                        //$this->turnOnLedSlot($slots, $colors->ledColor, $allOrderId);
                    }
                }
                if (isset($colors) && $colors != '') {
                    $colorId = $colors->ledColor;
                    $color = $colors->htmlCode;
                } else {
                    $colorId = '';
                    $color = '';
                }
                return $this->render('show-orders', [
                            'slots' => $slots,
                            'allSlot' => $allSlot,
                            'colorId' => $colorId,
                            'color' => $color,
                            'allOrderId' => $allOrderId,
                            'selection' => $_GET["selection"]
                ]);
            }
        } else if ($oldUser) {//ถ้าเป็นคนหยิบเก่าที่ยังหยิบของใน order ที่เลือกมายังไม่เสร็จ
            $storePicking = StorePicking::find()->where("pickerId = '" . $userId . "' and status = 4")->one();
            $allOrderId = explode(",", $storePicking->orderId);
            $slots = [];
            $i = 0;
            foreach ($allOrderId as $orderId):
                $items = OrderItem::find()->where("orderId = " . $orderId . " and DATE(DATE_SUB(sendDateTime, INTERVAL " . OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE()")->all();
                if (isset($items) && !empty($items)) {
                    //throw new \yii\base\Exception('11');
                    foreach ($items as $item):
                        //throw new \yii\base\Exception('2');
                        $flag = false;
                        if (isset($_GET['qrSlot'])) {//ถ้ามีการ ค้นหาด้วย qrcode
                            $storeSlot = \common\models\costfit\StoreSlot::find()->where("barcode = '" . $_GET['qrSlot'] . "'")->one();
                            if ($_GET['qrSlot'] == '') {
                                return $this->redirect($baseUrl . '/store/picking');
                            }
                            if (isset($storeSlot)) {
                                $slots[0] = $storeSlot->storeSlotId;
                            } else {
                                $slots[0] = 'a';
                            }
                        } else {
                            //$slot = \common\models\costfit\StoreProductArrange::find()->where("productId = " . $item->productId . " and status = 4 and quantity !=0")->one(); //หา slot  ที่ product วางอยู่ และ ไม่เท่ากับ 0
                            $slot = \common\models\costfit\StoreProductArrange::find()->where("productSuppId = " . $item->productSuppId . " and status = 4 and quantity !=0")->one(); //หา slot  ที่ product วางอยู่ และ ไม่เท่ากับ 0
                            if (isset($slot)) {
                                $flag = $this->checkSlot($slots, $slot->slotId);
                                if ($flag) {
                                    $slots[$i] = $slot->slotId;
                                    $i++;
                                }
                            } else {
                                $ms = 'products not found in store!'; //ถ้าไม่มีสิ้นค้าใน store
                            }
                        }
                    endforeach;
                }
            endforeach;
//throw new \yii\base\Exception(print_r($slots, true));
            if ($slots[0] != '') {
                $allSlot = new \common\models\costfit\StoreSlot(); //หา slot
                if ($slots[0] == 'a') {
                    $color = '';
                } else {
                    $old = $this->checkOldUser($allOrderId); //ถ้ายังทำรายการไม่เสร็จ ยังไม่เปลี่ยนหรือ ปิดไฟ
                    if ($old == 'no') {
                        $colors = \common\models\costfit\Led::variableColor($allSlot->getSlotName($slots[0]));
                        $this->turnOnLedSlot($slots, $colors->ledColor, $allOrderId);
                    } else {

                        $colors = \common\models\costfit\LedColor::find()->where("ledColor = " . $old)->one();
                        //$this->turnOnLedSlot($slots, $colors->ledColor, $allOrderId);
                    }
                }
                if (isset($colors) && $colors != '') {
                    $colorId = $colors->ledColor;
                    $color = $colors->htmlCode;
                } else {
                    $colorId = '';
                    $color = '';
                }
                return $this->render('show-orders', [
                            'slots' => $slots,
                            'allSlot' => $allSlot,
                            'colorId' => $colorId,
                            'color' => $color,
                            'allOrderId' => $allOrderId,
                            'selection' => $allOrderId
                ]);
            }
        } else {

            return $this->render('index', [
                        'dataProvider' => $dataProvider,
                        'selects' => $select,
                        'alert' => $alert
            ]);
        }
    }

    public function actionPickItem() {
        //$orderItems = \common\models\costfit\OrderItem::find()->where("orderId = " . $_GET['orderId'] . " and productId = " . $_GET['productId'])->all();
        $orderItems = OrderItem::find()->where("orderId = " . $_GET['orderId'] . " and productSuppId = " . $_GET['productId'])->all();
        $allSlot = new \common\models\costfit\StoreSlot();
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $countSlot = 0;
        $userId = Yii::$app->user->identity->userId;
        $this->updateArrange($_GET['orderId'], $_GET['productId'], $_GET['slot']);
        //$count = count(\common\models\costfit\StoreProductArrange::find()->where("orderId = " . $_GET['orderId'] . " and productId = " . $_GET['productId'] . " and status = 99")->all());
        $count = count(\common\models\costfit\StoreProductArrange::find()->where("orderId = " . $_GET['orderId'] . " and productSuppId = " . $_GET['productId'] . " and status = 99")->all());
        if (isset($orderItems)) {
            if ($count == 0) {//หยิบไอเทมนั้นในออเดอร์ หมดทุก slot แล้ว?
                foreach ($orderItems as $orderItem):
                    $orderItem->status = OrderItem::ORDERITEM_PICKED;
                    $orderItem->pickerId = $userId;
                    $orderItem->updateDateTime = new \yii\db\Expression('NOW()');
                    $orderItem->save(false);
                endforeach;
                //set pinked product in orderItem to  5  (หยิบแล้ว)
            }
            $this->checkOrder($_GET['orderId']);
//            $arrange = \common\models\costfit\StoreProductArrange::find()->where("slotId = " . $_GET['slot'] . " and productId = " . $_GET['productId'])->all();
//            foreach ($arrange as $arProduct):
//                foreach ($_GET['allOrderId'] as $orderId):
//                    $orderItem = \common\models\costfit\OrderItem::find()->where("orderId = " . $orderId . " and productId = " . $arProduct->productId . " and status = 4")->all();
//                    if (isset($orderItem) && !empty($orderItem)) {
//                        $countSlot++;
//                    }
//                endforeach;
//            endforeach;
            //$arrange = \common\models\costfit\StoreProductArrange::find()->where("orderId = " . $_GET['orderId'] . " and productId = " . $_GET['productId'] . " and slotId = " . $_GET['slot'] . " and pickerId = " . $userId . " and status = 99")->all(); //slot หยิบไอเทมของตัวเองหมดหรือยัง
            $arrange = \common\models\costfit\StoreProductArrange::find()->where("slotId = " . $_GET['slot'] . " and pickerId = " . $userId . " and status = 99")->all(); //slot หยิบไอเทมของตัวเองหมดหรือยัง
            $countSlot = count($arrange);
            if ($countSlot == 0) {//เมื่อ หยิบครบทุก Item ใน slot นั้น ==> ปิดไฟ(set status=0)
                $slot = \common\models\costfit\StoreSlot::find()->where("storeSlotId = " . $_GET['slot'])->one();
                $led = \common\models\costfit\Led::find()->where("slot = '" . $slot->barcode . "'")->one();
                $ledItem = LedItem::find()->where("ledId = " . $led->ledId . " and color = " . $_GET['colorId'])->one();
                $ledItem->status = 0;
                $ledItem->save();
                //throw new \yii\base\Exception($slot->barcode . "," . $_GET['colorId']);
                //Yii::$app->runAction('led/led/close-led', ['slot' => $slot->barcode, 'colorId' => $_GET['colorId']]);
                $checkCloseAll = LedItem::find()->where("color = " . $_GET['colorId'] . " and status = 1")->all();
                if (empty($checkCloseAll)) {
                    $ledColor = \common\models\costfit\LedColor::find()->where("ledColor = " . $_GET['colorId'])->one(); //set ไฟ สีนั้นให้ว่าง
                    $ledColor->status = 0;
                    $ledColor->save();
                    $picker = StorePicking::find()->where("pickerId = '" . $userId . "' and status = 4")->one();
                    if (isset($picker)) {
                        $picker->status = 5;
                        $picker->updateDateTime = new \yii\db\Expression('NOW()');
                        $picker->save();
                        return $this->redirect($baseUrl . '/store/picking/view');
                    }
//throw new \yii\base\Exception(print_r($checkCloseAll, true));
                }
//throw new \yii\base\Exception('ปิดไฟสี ' . $_GET['color'] . 'ที่ ' . $led->slot);
            }
            return $this->render('show-orders', [
                        'slots' => $_GET['arraySlots'],
                        'allSlot' => $allSlot,
                        'colorId' => $_GET['colorId'],
                        'color' => $_GET['color'],
                        'allOrderId' => $_GET['allOrderId'],
                        'selection' => $_GET["selection"]
            ]);
        }
//throw new \yii\base\Exception("slot => " . $_GET['slot'] . " productId => " . $_GET['productId'] . " orderId => " . $_GET['orderId'] . " orderItemId => " . $_GET['orderItemId'] . " ledId => " . $_GET['colorId']);
    }

    public function actionView() {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        return $this->render('view');
    }

    public function actionPrintOrder() {
// $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
//throw new \yii\base\Exception($baseUrl);
        $orderId = '';
        foreach ($_GET['order'] as $order):
            $orderId = $orderId . $order . ",";
        endforeach;
        $id = trim(substr($orderId, 0, -1));
//throw new \yii\base\Exception($id);
        $order = Order::find()->where("orderId in ($id)")->all();
        $header = $this->renderPartial('header', [
            'orders' => $order
        ]);
        $content = $this->renderPartial('content', [
            'orders' => $order
        ]);
        $this->printPdf($content, $header);
    }

    static function checkVariableOrder($selectOrder) {
        $select = TRUE;
        foreach ($selectOrder as $order):
            $check = Order::find()->where("orderId=" . $order)->one();
            if ($check->status != Order::ORDER_STATUS_CREATEPO) {
                $select = FALSE;
            }
        endforeach;
        return $select;
    }

    static function updateArrange($orderId, $productId, $slot) {
        //$arrange = \common\models\costfit\StoreProductArrange::find()->where("slotId = " . $slot . " and orderId = " . $orderId . " and productId = " . $productId)->all();
        $arrange = \common\models\costfit\StoreProductArrange::find()->where("slotId = " . $slot . " and orderId = " . $orderId . " and productSuppId = " . $productId)->all();
        foreach ($arrange as $arr):
            $arr->status = 100;
            $arr->save(false);
        endforeach;
    }

    static function checkQuantity($allOrder) {//allslots are barcodd
        $products[] = 0;
        $returnId = '';
        $arrangTotal = 0;
        $result = 0;
        $oldResult = 0;
        //throw new \yii\base\Exception(print_r($allOrder, true));
        foreach ($allOrder as $orderId)://หาว่าใน order ที่เลือกมา มี Product อะไรบ้าง
            $i = 0;
            $orderItems = OrderItem::find()->where("orderId = " . $orderId . " and DATE(DATE_SUB(sendDateTime, INTERVAL " . OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE()")->all();

            if (isset($orderItems) && !empty($orderItems)) {
                foreach ($orderItems as $item):
                    //$arranges = \common\models\costfit\StoreProductArrange::find()->where("productId = " . $item->productId . " and status = 4")->all();
                    $arranges = \common\models\costfit\StoreProductArrange::find()->where("productSuppId = " . $item->productSuppId . " and status = 4")->all();

                    if (isset($arranges) && !empty($arranges)) {
                        foreach ($arranges as $arrange):
                            $arrangTotal += $arrange->result;
                        endforeach;

                        $result = $arrangTotal - $item->quantity;
                        //    throw new \yii\base\Exception($result . "=" . $arrangTotal . "-" . $item->quantity);

                        if ($result < $oldResult) {//ถ้าของใน arrange store ไม่พอ
                            $i++;
                        } else {
                            $oldResult = $result;
                        }
                    } else {//ถ้าไม่มีใน StoreProductArrange
                        $i++;
                    }

                endforeach;
            }if ($i == 0) {
                $returnId .= $orderId . ",";
            }
        endforeach;
        $returnId = substr($returnId, 0, -1);
        //throw new \yii\base\Exception($returnId);
        return $returnId;
    }

    static function checkSlot($oldArraySlot, $newSlot) {
        if (isset($oldArraySlot) && !empty($oldArraySlot)) {
            $i = 0;
            foreach ($oldArraySlot as $old):
                if ($old == $newSlot) {
                    $i++;
                }
            endforeach;
            if ($i == 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    static function turnOnLedSlot($allSlot, $color, $allOrderId) {//allslots are barcode
        $allSlots = new \common\models\costfit\StoreSlot();
        foreach ($allSlot as $slot):
            $slotName = $allSlots->getSlotName($slot);

            $led = \common\models\costfit\Led::find()->where("slot = '" . $slotName . "'")->one(); //หาว่า อยู่ slot ไหน
            //throw new \yii\base\Exception($slot);
            $ledItem = LedItem::find()->where("ledId = " . $led->ledId . " and color = " . $color)->one();
            $ledItem->status = 1; //เปิดไฟที่ slot
            $ledItem->save();
        endforeach;
        foreach ($allOrderId as $orderId):
            $orderItems = OrderItem::find()->where("orderId = " . $orderId . " and DATE(DATE_SUB(sendDateTime, INTERVAL " . OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE()")->all();
            if (isset($orderItems) && !empty($orderItems)) {
                foreach ($orderItems as $item):
                    $item->color = $color;
                    $item->save(false);
                endforeach;
            }
            $order = Order::find()->where("orderId = " . $orderId)->one();
            $order->color = $color;
            $order->save(false);
        endforeach;
    }

    /* static function updateQuantity($allOrderId) {
      $different = 0;
      $userId = '1234';
      foreach ($allOrderId as $orderId):
      $orderItmes = \common\models\costfit\OrderItem::find()->where("orderId = " . $orderId . " and status!=4 and status!=5")->all();
      if (isset($orderItmes) && !empty($orderItmes)) {
      foreach ($orderItmes as $item):
      $arranges = \common\models\costfit\StoreProductArrange::find()->where("productId = " . $item->productId . " and status = 4")->all();
      $nextSlotResult = $item->quantity;
      if (isset($arranges) && !empty($arranges)) {
      foreach ($arranges as $arrange):
      $different = $arrange->quantity - $nextSlotResult; //อัพเดทยอดที่เหลือ เพื่อไปหาใน slot ถัดไป
      $createState = new \common\models\costfit\StoreProductArrange();
      if ($different >= 0) {//slot นี้มีของพอ
      $createState->quantity = -($nextSlotResult);
      $arrange->result = $arrange->quantity - $item->quantity;
      } else {//เมื่อ มีของไม่พอใน slot ให้ไปหา slot ถัดไป
      $createState->quantity = -($arrange->quantity);
      $nextSlotResult = $item->quantity - $arrange->quantity;
      $arrange->result = 0;
      }
      $createState->storeProductId = $arrange->storeProductId;
      $createState->productId = $arrange->productId;
      $createState->slotId = $arrange->slotId;
      $createState->parentId = $arrange->storeProductArrangeId;
      $createState->orderId = $item->orderId;
      $createState->status = 99;
      $createState->createDateTime = new \yii\db\Expression('NOW()');
      $createState->updateDateTime = new \yii\db\Expression('NOW()');
      $createState->save(false);
      $arrange->save();
      if ($different >= 0) {
      break;
      }

      endforeach;
      }
      if ($item->status != 5) {//ป้องกันการ refresh
      $item->status = 4; //เปลี่ยนสถานะเป็นกำลัง หยิบ
      } else {
      $item->status = 5;
      }
      $item->save(false);
      endforeach;
      $order = \common\models\costfit\Order::find()->where("orderId = " . $orderId)->one();
      if ($order->status != 12) {
      $order->status = 11; //กำลังหยิบ
      $order->pickerId = $userId;
      } else {
      $order->status = 12; //เสร็จแล้ว
      }
      $order->save(false);
      }
      endforeach;
      } */

    static function saveSelection($orderId, $userId) {
        if (isset($orderId)) {
            $strId = '';
            foreach ($orderId as $id):
                $strId = $strId . $id . ",";
            endforeach;
            $str = substr($strId, 0, -1);
            $old = StorePicking::find()->where("pickerId = '" . $userId . "' and status = 4")->one();
            if (count($old) == 0) {
                $picking = new StorePicking();
                $picking->pickerId = $userId;
                $picking->status = 4;
                $picking->orderId = $str;
                $picking->createDateTime = new \yii\db\Expression('NOW()');
                $picking->updateDateTime = new \yii\db\Expression('NOW()');
                $picking->save(false);
            }
        }
    }

    static function checkOldUser($allOrderId) {
        $i = 0;
        $color = 0;
        $new = 0;
        foreach ($allOrderId as $orderId):
            $orders = Order::find()->where("orderId = " . $orderId)->all();
            if (isset($orders) && !empty($orders)) {
                foreach ($orders as $order):
                    if (($order->color != null) && ($order->color != 0)) {
                        $i++;
                        $color = $order->color;
                        $orderItem = OrderItem::find()->where("orderId=" . $order->orderId . " and (color='' or color=0) and DATE(DATE_SUB(sendDateTime, INTERVAL " . OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE()")->all();
                        if (isset($orderItem) && !empty($orderItem)) {
                            $new++;
                        }
                    }
                endforeach;
            }
        endforeach;
        if ($new > 0) {
            $i = 0;
        }
        if ($i == 0) {
            return 'no';
        } else {
            return $color;
        }
    }

    static function checkOldPicker($userId) {
        $orders = Order::find()->where("pickerId = " . $userId . " and status =" . Order::ORDER_STATUS_PICKING)->all();
        if (count($orders) > 0) {
            return true;
        } else {
            return false;
        }
    }

    static function checkOrder($orderId) {
        $i = 0;
        if (isset($orderId) && !empty($orderId)) {
            $orders = OrderItem::find()->where("orderId = " . $orderId)->all();
            if (isset($orders) && !empty($orders)) {
                foreach ($orders as $order):
                    if ($order->status == OrderItem::ORDERITEM_PICKING) {
                        $i++;
                    }
                endforeach;
                if ($i == 0) {
                    $a = Order::find()->where("orderId = " . $orderId)->one();
                    $a->status = Order::ORDER_STATUS_PICKED;
                    $a->updateDateTime = new \yii\db\Expression('NOW()');
                    $a->save(false);
                }
            }
        }
    }

    static function checkEnoughItemInSlot($slotId, $productId, $quantity) {
        $total = 0;
        //$productArranges = \common\models\costfit\StoreProductArrange::find()->where("slotId = " . $slotId . " and productId = " . $productId . " and status = 4")->all();
        $productArranges = \common\models\costfit\StoreProductArrange::find()->where("slotId = " . $slotId . " and productSuppId = " . $productId . " and status = 4")->all();
        if (isset($productArranges) && !empty($productArranges)) {
            foreach ($productArranges as $productArrange):
                $total += $productArrange->result;
            endforeach;
            if ($total >= $quantity) {
                return true;
            } else {
                return false;
            }
        }
    }

    static function updateSlot($slotId, $productId, $quantity, $orderId) {
        //throw new \yii\base\Exception($quantity);
        $userId = Yii::$app->user->identity->userId;
        //$productArrange = \common\models\costfit\StoreProductArrange::find()->where("slotId = " . $slotId . " and productId = " . $productId . " and status = 4 and result!=0 order by createDateTime")->one();
        $productArrange = \common\models\costfit\StoreProductArrange::find()->where("slotId = " . $slotId . " and productSuppId = " . $productId . " and status = 4 and result!=0 order by createDateTime")->one();
        //$orderItem = \common\models\costfit\OrderItem::find()->where("orderId = " . $orderId . " and productId = " . $productId . " and status = 1 and DATE(DATE_SUB(sendDateTime, INTERVAL " . \common\models\costfit\OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE()")->one();
        $orderItem = OrderItem::find()->where("orderId = " . $orderId . " and productSuppId = " . $productId . " and status = 1 and DATE(DATE_SUB(sendDateTime, INTERVAL " . OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE()")->one();
        $order = Order::find()->where("orderId = " . $orderId)->one();
        if (isset($orderItem) && !empty($orderItem)) {
            if (($orderItem->status != 4) && (($orderItem->status != 5))) {
                if (isset($productArrange) && !empty($productArrange)) {
                    if ($productArrange->result >= $quantity) {
                        $result = $productArrange->result - $quantity;
                        $pick = $quantity;
                        $orderItem->status = 4;
                    } else {
                        $result = 0;
                        $pick = $productArrange->result;
                        $orderItem->status = 1;
                    }
                    $productArrange->result = $result;
                    $productArrange->updateDateTime = new \yii\db\Expression('NOW()');
                    $createState = new \common\models\costfit\StoreProductArrange();
                    $createState->storeProductId = $productArrange->storeProductId;
                    $createState->productId = $productArrange->productId;
                    $createState->productSuppId = $productArrange->productSuppId;
                    $createState->slotId = $productArrange->slotId;
                    $createState->parentId = $productArrange->storeProductArrangeId;
                    $createState->orderId = $orderId;
                    $createState->quantity = -($pick);
                    $createState->pickerId = $userId;
                    $createState->status = 99;
                    $createState->createDateTime = new \yii\db\Expression('NOW()');
                    $createState->updateDateTime = new \yii\db\Expression('NOW()');
                    $createState->save(false);
                    $productArrange->save();
                    $orderItem->pickerId = $userId;
                    $orderItem->updateDateTime = new \yii\db\Expression('NOW()');
                    $orderItem->save();
                    $order->status = Order::ORDER_STATUS_PICKING;
                    $order->pickerId = $userId;
                    $order->updateDateTime = new \yii\db\Expression('NOW()');
                    $order->save();
                }
            }
        }
    }

    static function printPdf($content, $header) {
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@backend/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:14px}',
            //'cssInline' => 'body{font-size:9px}',
            // set mPDF properties on the fly
            // 'defaultFontSize' => 3,
            // 'marginLeft' => 10,
            // 'marginRight' => 10,
            'marginTop' => 10,
            // 'marginBottom' => 11,
            //'marginHeader' => 6,
            //'marginFooter' => 6,
            // 'options' => ['title' => 'Cost.fit Print '],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => [$header], //Krajee Report Header
                // 'SetFooter' => ['{PAGENO}'],
                // 'SetHeader' => FALSE, //Krajee Report Header
                'SetFooter' => ['{PAGENO} / {nbpg}'],
            ]
        ]);


        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionTest() {
        $model = new \common\models\costfit\LedColor();
        return $this->render('test', [
                    'model' => $model
        ]);
    }

}
