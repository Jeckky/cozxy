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
use kartik\mpdf\Pdf;

class PickingController extends StoreMasterController {

    public function beforeAction($action) {
        if ($action->id == 'ping-hardware' || $action->id == 'select-led' || $action->id == 'add-led-to-slot') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $userId = '1234';
        $oldUser = $this->checkOldPicker($userId); // ถ้าเป็นคนหยิบของที่หยิบของในออเดอร์ที่เลือกมายังไม่เสร็จ บังคับให้กลับบมาหน้าหยิบให้เสร็จ
        $findEnough = \common\models\costfit\Order::find()
                        ->join("LEFT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
                        ->where("DATE(DATE_SUB(oi.sendDateTime,INTERVAL " . \common\models\costfit\OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() AND `order`.status = " . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS)->all();
        $allId = [];
        $e = 0;
        if (isset($findEnough)):
            foreach ($findEnough as $enoughOrderId)://หา orderId ทั้งหมด ที่พร้อมส่ง ก่อนที่จะเชคว่ามีพอหรือปล่าว
                $allId[$e] = $enoughOrderId->orderId;
                $e++;
            endforeach;
        endif;
        $enoughId = $this->checkQuantity($allId); //ได้ orderId ที่มีของพอ
        if ($enoughId != '') {
            //throw new \yii\base\Exception('aaaa');
            $query = \common\models\costfit\Order::find()
                    ->join("LEFT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
                    ->where("DATE(DATE_SUB(oi.sendDateTime,INTERVAL " . \common\models\costfit\OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() AND `order`.status = " . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . " and order.orderId in(" . $enoughId . ")");
        } else {//ถ้า มีของใน order ไม่ครบ
            // throw new \yii\base\Exception('aa');
            $query = \common\models\costfit\Order::find()
                    ->where("orderId=0");

            //$query = '';
//            throw new \yii\base\Exception('bbbb');
//            $query = \common\models\costfit\Order::find()
//                    ->join("LEFT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
//                    ->where("DATE(DATE_SUB(oi.sendDateTime,INTERVAL " . \common\models\costfit\OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() AND `order`.status = " . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $allOrderId = '';
        if (isset($_GET["selection"])) {//checkbox return มาเป็น orderId
            $allOrderId = $_GET["selection"];
            $slots = [];
            $i = 0;
            $this->updateQuantity($allOrderId); //ตัดสต๊อก
            $this->saveSelection($allOrderId, $userId); //บัน
//$ms = '';
            foreach ($allOrderId as $orderId):
                $items = \common\models\costfit\OrderItem::find()->where("orderId = " . $orderId)->all();
                if (isset($items) && !empty($items)) {
                    foreach ($items as $item):
                        $flag = false;
                        if (isset($_GET['qrSlot']) && $_GET['qrSlot'] != '') {//ถ้ามีการ ค้นหาด้วย qrcode
                            $storeSlot = \common\models\costfit\StoreSlot::find()->where("barcode = '" . $_GET['qrSlot'] . "'")->one();
                            if (isset($storeSlot)) {
                                $slots[0] = $storeSlot->storeSlotId;
                            } else {
                                $slots[0] = 'a';
                            }
                        } else {
                            $slot = \common\models\costfit\StoreProductArrange::find()->where("productId = " . $item->productId . " and status=4 and quantity !=0")->one(); //หา slot  ที่ product วางอยู่ และ ไม่เท่ากับ 0
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
                        $colors = \common\models\costfit\LedColor::find()->where("ledColor=" . $old)->one();
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
            $storePicking = StorePicking::find()->where("pickerId='" . $userId . "' and status=4")->one();
            $allOrderId = explode(",", $storePicking->orderId);
            $slots = [];
            $i = 0;
            foreach ($allOrderId as $orderId):
                $items = \common\models\costfit\OrderItem::find()->where("orderId = " . $orderId)->all();
                if (isset($items) && !empty($items)) {
                    foreach ($items as $item):
                        $flag = false;
                        if (isset($_GET['qrSlot']) && $_GET['qrSlot'] != '') {//ถ้ามีการ ค้นหาด้วย qrcode
                            $storeSlot = \common\models\costfit\StoreSlot::find()->where("barcode = '" . $_GET['qrSlot'] . "'")->one();
                            if (isset($storeSlot)) {
                                $slots[0] = $storeSlot->storeSlotId;
                            } else {
                                $slots[0] = 'a';
                            }
                        } else {
                            $slot = \common\models\costfit\StoreProductArrange::find()->where("productId = " . $item->productId . " and status=4 and quantity !=0")->one(); //หา slot  ที่ product วางอยู่ และ ไม่เท่ากับ 0
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
                        $colors = \common\models\costfit\LedColor::find()->where("ledColor=" . $old)->one();
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
                            // 'ms' => $ms
            ]);
        }
    }

    public function actionPickItem() {
        $orderItem = \common\models\costfit\OrderItem::find()->where("orderItemId = " . $_GET['orderItemId'])->one();
        $allSlot = new \common\models\costfit\StoreSlot();
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $countSlot = 0;
        $userId = '1234';
        if (isset($orderItem)) {
            $orderItem->status = 5;
            $orderItem->pickerId = '1234'; //รอ login
            $orderItem->updateDateTime = new \yii\db\Expression('NOW()');
            $orderItem->save(); //set pinked product in orderItem to  5  (หยิบแล้ว)
            $this->checkOrder($orderItem->orderId);
            $arrange = \common\models\costfit\StoreProductArrange::find()->where("slotId = " . $_GET['slot'])->all();
            foreach ($arrange as $arProduct):
                foreach ($_GET['allOrderId'] as $orderId):
                    $orderItem = \common\models\costfit\OrderItem::find()->where("orderId = " . $orderId . " and productId = " . $arProduct->productId . " and status = 4")->all();
                    if (isset($orderItem) && !empty($orderItem)) {
                        $countSlot++;
                    }
                endforeach;
            endforeach;
            if ($countSlot == 0) {//เมื่อ หยิบครบทุก Item ใน slot นั้น ==> ปิดไฟ(set status=0)
                $slot = \common\models\costfit\StoreSlot::find()->where("storeSlotId = " . $_GET['slot'])->one();
                $led = \common\models\costfit\Led::find()->where("slot = '" . $slot->barcode . "'")->one();
                $ledItem = LedItem::find()->where("ledId = " . $led->ledId . " and color = " . $_GET['colorId'])->one();
                $ledItem->status = 0;
                $ledItem->save();
                $checkCloseAll = LedItem::find()->where("color = " . $_GET['colorId'] . " and status = 1")->all();
                if (empty($checkCloseAll)) {
                    $ledColor = \common\models\costfit\LedColor::find()->where("ledColor = " . $_GET['colorId'])->one(); //set ไฟ สีนั้นให้ว่าง
                    $ledColor->status = 0;
                    $ledColor->save();
                    $picker = StorePicking::find()->where("pickerId='" . $userId . "' and status=4")->one();
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
        $id = substr($orderId, 0, -1);
//throw new \yii\base\Exception($id);
        $order = \common\models\costfit\Order::find()->where("orderId in ($id)")->all();
        $header = $this->renderPartial('header', [
            'orders' => $order
        ]);
        $content = $this->renderPartial('content', [
            'orders' => $order
        ]);
        $this->printPdf($content, $header);
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
            $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->all();
            if (isset($orderItems) && !empty($orderItems)) {
                foreach ($orderItems as $item):
                    $arranges = \common\models\costfit\StoreProductArrange::find()->where("productId=" . $item->productId . " and status=4")->all();
                    if (isset($arranges) && !empty($arranges)) {
                        foreach ($arranges as $arrange):
                            $arrangTotal+=$arrange->result;
                        endforeach;
                        $result = $arrangTotal - $item->quantity;
                        if ($result <= $oldResult) {//ถ้าของใน arrange store ไม่พอ
                            $i++;
                        } else {
                            $oldResult = $result;
                        }
                    } else {//ถ้าไม่มีใน StoreProductArrange
                        $i++;
                    }

                endforeach;
            }if ($i == 0) {
                $returnId.=$orderId . ",";
            }
        endforeach;
        $returnId = substr($returnId, 0, -1);
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
            $ledItem = LedItem::find()->where("ledId = " . $led->ledId . " and color = " . $color)->one();
            $ledItem->status = 1; //เปิดไฟที่ slot
            $ledItem->save();
        endforeach;
        foreach ($allOrderId as $orderId):
            $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->all();
            if (isset($orderItems) && !empty($orderItems)) {
                foreach ($orderItems as $item):
                    $item->color = $color;
                    $item->save(false);
                endforeach;
            }
            $order = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->one();
            $order->color = $color;
            $order->save(false);
        endforeach;
    }

    static function updateQuantity($allOrderId) {
        $different = 0;
        $userId = '1234';
        foreach ($allOrderId as $orderId):
            $orderItmes = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId . " and status!=4 and status!=5")->all();
            if (isset($orderItmes) && !empty($orderItmes)) {
                foreach ($orderItmes as $item):
                    $arranges = \common\models\costfit\StoreProductArrange::find()->where("productId=" . $item->productId . " and status=4")->all();
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
                $order = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->one();
                if ($order->status != 12) {
                    $order->status = 11; //กำลังหยิบ
                    $order->pickerId = $userId;
                } else {
                    $order->status = 12; //เสร็จแล้ว
                }
                $order->save(false);
            }
        endforeach;
    }

    static function saveSelection($orderId, $userId) {
        if (isset($orderId)) {
            $strId = '';
            foreach ($orderId as $id):
                $strId = $strId . $id . ",";
            endforeach;
            $str = substr($strId, 0, -1);
            $old = StorePicking::find()->where("pickerId='" . $userId . "' and status=4")->one();
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
        foreach ($allOrderId as $orderId):
            $orders = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->all();
            if (isset($orders) && !empty($orders)) {
                foreach ($orders as $order):
                    if (($order->color != null) && ($order->color != 0)) {
                        $i++;
                        $color = $order->color;
                    }
                endforeach;
            }
        endforeach;
        if ($i == 0) {
            return 'no';
        } else {
            return $color;
        }
    }

    static function checkOldPicker($userId) {
        $orders = \common\models\costfit\Order::find()->where("pickerId=" . $userId . " and status=11")->all();
        if (count($orders) > 0) {
            return true;
        } else {
            return false;
        }
    }

    static function checkOrder($orderId) {
        if (isset($orderId) && !empty($orderId)) {
            $order = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->one();
            $order->status = 12;
            $order->updateDateTime = new \yii\db\Expression('NOW()');
            $order->save(false);
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

}
