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
use kartik\mpdf\Pdf;
use common\models\costfit\OrderItemPacking;
use common\models\costfit\Order;
use common\models\costfit\OrderItem;
use common\models\costfit\Product;
use common\models\costfit\ProductSuppliers;

class PackingController extends StoreMasterController {

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
        if ($action->id == 'ping-hardware' || $action->id == 'select-led' || $action->id == 'add-led-to-slot' || $action->id == 'print-label') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        if (!isset(Yii::$app->user->identity->userId)) {
            return $this->redirect($baseUrl . '/auth');
        }
        $query = Order::find()
        ->join("LEFT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
        ->where("DATE(DATE_SUB(oi.sendDateTime,INTERVAL " . OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() AND (`order`.status = " . Order::ORDER_STATUS_PICKED . " OR `order`.status =" . Order::ORDER_STATUS_PACKED . " )")
        ->orderBy("`order`.status ASC");

        $ms = '';
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (isset($_GET['orderNo']) && !empty($_GET['orderNo'])) {
            $order = Order::find()->where("orderNo='" . $_GET['orderNo'] . "' and status=12")->one();
            if (isset($order) && !empty($order)) {
                return $this->render('show-orders', [
                    'orderId' => $order->orderId,
                ]);
            } else {
                $ms = 'ไม่พบออร์เดอร์นี้ หรือ ออร์เดอร์นี้ถูกแพ็คแล้ว';
                return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'ms' => $ms
                ]);
            }
        } else {
            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionPacking() {
        $ms = '';
        $save = false;
        $sameType = false;
        if (!isset(Yii::$app->user->identity->userId)) {
            return $this->redirect($baseUrl . '/auth');
        }
        if (isset($_GET['item'])) {
            $order = Order::find()->where("orderId=" . $_GET['orderId'])->one();
            $productId = Product::findProductSuppId($_GET['item'], $_GET['orderId']);
            throw new \yii\base\Exception($productId);
            if (isset($order)) {
                if (isset($productId) && !empty($productId)) {
                    //$items = \common\models\costfit\OrderItem::find()->where("orderId=" . $order->orderId . " and productId=" . $productId . " and status=" . \common\models\costfit\OrderItem::ORDERITEM_PICKED)->one();
                    $items = OrderItem::find()->where("orderId=" . $order->orderId . " and productSuppId=" . $productId . " and status=" . OrderItem::ORDERITEM_PICKED)->one();
                    if (isset($items) && !empty($items)) {
                        $packingItems = OrderItemPacking::find()->where("orderItemId=" . $items->orderItemId . " and status=99 and packer=" . Yii::$app->user->identity->userId)->one(); //ได้ตัวที่อยู่ในถุงแต่ยังไม่ปิดถุง
                        if (isset($packingItems)) {

                            $save = $this->checkSum($items->orderItemId, $items->quantity);
                            if ($save == true) {
                                $sameType = $this->checkSameType($items->receiveType);
                                if ($sameType == true) {
                                    $packingItems->quantity += 1;
                                    $packingItems->updateDateTime = new \yii\db\Expression('NOW()');
                                    $packingItems->save(false);
                                } else {
                                    $ms = 'ไม่สามารถดำเนินการได้ เนื่องจากเป็นการส่งคนละประเภท';
                                }
                            } else {
                                $ms = 'ไม่สามารถดำเนินการได้ เนื่องจาก สินค้าเกินจำนวนใน Order';
                            }
                        } else {
                            $save = $this->checkSum($items->orderItemId, $items->quantity);
                            $sameType = $this->checkSameType($items->receiveType);
                            if ($save == true) {
                                if ($sameType == true) {
                                    $packing = new OrderItemPacking();
                                    $packing->orderItemId = $items->orderItemId;
                                    $packing->quantity = 1;
                                    $packing->packer = Yii::$app->user->identity->userId;
                                    $packing->status = 99;
                                    $packing->createDateTime = new \yii\db\Expression('NOW()');
                                    $packing->updateDateTime = new \yii\db\Expression('NOW()');
                                    $packing->save(false);
                                } else {
                                    $ms = 'ไม่สามารถดำเนินการได้ เนื่องจากเป็นการส่งคนละประเภท';
                                }
                            } else {
                                $ms = 'ไม่สามารถดำเนินการได้ เนื่องจาก สินค้าเกินจำนวนใน Order';
                            }
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
        $ms = '';
        $full = 0;
        if (!isset(Yii::$app->user->identity->userId)) {
            return $this->redirect($baseUrl . '/auth');
        }
        if (isset($_GET['orderId']) && !empty($_GET['orderId'])) {
            $itemInBag = $this->findItemInBag($_GET['orderId']);
            if (!empty($itemInBag)) {
                $inBags = OrderItemPacking::find()->where("orderItemId in($itemInBag) and status=99")->all();
                if (isset($inBags) && !empty($inBags)) {
                    foreach ($inBags as $inBag):

                        $fully = $this->checkFully($inBag->orderItemId); //เชคว่า item ครบตาม order หรือมั๊ย
                        if ($fully == false) {//ถ้ายังไม่ครบทุก item
                            $full++;
                        } else {
                            //$this->updateOrderItem($inBag->orderItemId);
                        }
                    endforeach;
                }

                if ($full > 0) {//ถ้ายังไม่ครบทุก item กลับไปหน้าสแกนโปรดักใส่ถุง (เปิดถุงใหม่)
                    return $this->render('show-orders', [
                        'orderId' => $_GET['orderId'],
                        'ms' => $ms,
                    ]);
                } else {//กลับไปหน้า index เพื่อ เลือก order ถัดไป
                    $checkOrder = $this->checkSuccessOrder($_GET['orderId']);
                    if ($checkOrder == true) {
                        return $this->render('show-orders', [
                            'orderId' => $_GET['orderId'],
                            'ms' => $ms,
                            'success' => 'yes'
                        ]);
                    } else {
                        return $this->render('show-orders', [
                            'orderId' => $_GET['orderId'],
                            'ms' => $ms,
                        ]);
                    }
                }
            } else {
                return $this->redirect('index');
//                $ms = 'ไม่มีสินค้าในถุง';
//                return $this->render('show-orders', [
//                    'orderId' => $_GET['orderId'],
//                    'ms' => $ms
//                ]);
            }
        } else {
            return $this->render('show-orders', [
                'orderId' => $_GET['orderId'],
                'ms' => $ms
            ]);
        }
    }

    public function actionPrintLabel() {
        $ms = '';
        $full = 0;
        if (isset($_POST['orderId']) && !empty($_POST['orderId'])) {
            $itemInBag = $this->findItemInBag($_POST['orderId']);
            if (!empty($itemInBag)) {
                $inBags = OrderItemPacking::find()->where("orderItemId in($itemInBag) and status=99")->all();
                if (count($inBags) > 0) {
                    $bagNo = $this->genBagNo();
                } else {
                    $bagNo = $this->genBagNo(true);
                }if (isset($inBags) && !empty($inBags)) {
                    foreach ($inBags as $inBag):
                        $inBag->status = 4;
                        $inBag->bagNo = $bagNo;
                        $inBag->updateDateTime = new \yii\db\Expression('NOW()');
                        $inBag->save(false);
                        $fully = $this->checkFully($inBag->orderItemId); //เชคว่า item ครบตาม order หรือมั๊ย
                        if ($fully == false) {//ถ้ายังไม่ครบทุก item
                            $full++;
                        } else {
                            $this->updateOrderItem($inBag->orderItemId);
                        }
                    endforeach;
                    if ($full == 0) {//กลับไปหน้า index เพื่อ เลือก order ถัดไป
                        $checkOrder = $this->checkSuccessOrder($_POST['orderId']);
                        if ($checkOrder == true) {
                            $this->updateOrder($_POST['orderId']);
                        }
                    }
                }
            }
            return \yii\helpers\Json::encode($bagNo);
        }
    }

    public function actionRemove() {
        if (!isset(Yii::$app->user->identity->userId)) {
            return $this->redirect($baseUrl . '/auth');
        }
        if (isset($_GET['packingId'])) {
            $itemPacking = OrderItemPacking::find()->where("orderItemPackingId=" . $_GET['packingId'])->one();
            if (isset($itemPacking) && !empty($itemPacking)) {
                $itemPacking->delete();
                return $this->render('show-orders', [
                    'orderId' => $_GET['orderId'],
                    'ms' => $_GET['ms']
                ]);
            } else {
                $ms = 'ไม่มีรายการ';
                return $this->render('show-orders', [
                    'orderId' => $_GET['orderId'],
                    'ms' => $ms
                ]);
            }
        }
    }

    public function actionBagLabel($bag) {
        if (!isset(Yii::$app->user->identity->userId)) {
            return $this->redirect($baseUrl . '/auth');
        }
        $orderItem = OrderItemPacking::find()->where("bagNo='" . $bag . "'")->one();
        $order = OrderItem::find()->where("orderItemId=" . $orderItem->orderItemId)->one();
        return $this->renderPartial('bag_label', [
            'bagNo' => $bag,
            'orderId' => $order->orderId
        ]);
    }

    public function actionMinus() {
        if (!isset(Yii::$app->user->identity->userId)) {
            return $this->redirect($baseUrl . '/auth');
        }
        if (isset($_GET['packingId'])) {
            $itemPacking = OrderItemPacking::find()->where("orderItemPackingId=" . $_GET['packingId'])->one();
            $itemPacking->quantity = $itemPacking->quantity - 1;
            $itemPacking->save(false);
            return $this->render('show-orders', [
                'orderId' => $_GET['orderId'],
                'ms' => $_GET['ms']
            ]);
        }
    }

    static function checkSum($orderItemId, $orderQuantity) {
        $orderInPacks = OrderItemPacking::find()->where("orderItemId=" . $orderItemId)->all();
        $total = 0;
        if (isset($orderInPacks) && !empty($orderInPacks)) {
            foreach ($orderInPacks as $orderInPack):
                $total += $orderInPack->quantity;
            endforeach;
            if ($total < $orderQuantity) {//ถ้า ยังไม่ครบ
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    static function checkSameType($receiveType) {
        $orderItemInBag = OrderItemPacking::find()->where("packer=" . Yii::$app->user->identity->userId . " and status=99")->one(); //หาประเภทของการรับของ ของสินค้าที่เอาใส่ถุงไปก่อนหน้า
        if (isset($orderItemInBag) && !empty($orderItemInBag)) {
            $orderItem = OrderItem::find()->where("orderItemId=" . $orderItemInBag->orderItemId)->one();
            //throw new \yii\base\Exception($receiveType . ' old=>' . $orderItem->receiveType);
            if ($orderItem->receiveType == $receiveType) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    static function findItemInBag($orderId) {
        $orderItems = OrderItem::find()->where("orderId=" . $orderId . " and status=5")->all();
        $items = '';
        if (isset($orderItems) && !empty($orderItems)) {
            foreach ($orderItems as $orderItem):
                $items = $items . $orderItem->orderItemId . ",";
            endforeach;
            $items = substr($items, 0, -1);
        }
        return $items;
    }

    static function genBagNo($getLast = FALSE) {
        $prefix = 'BG'; //$supplierModel->prefix;
        $order = OrderItemPacking::find()->where("substr(bagNo,1,2)='" . $prefix . "' order by bagNo DESC ")->one();
//throw new \yii\base\Exception($order->bagNo);
        $max_code = isset($order) ? $order->bagNo : '0000000';
        $max_code = substr($max_code, -7);
        if (!$getLast) {
            $max_code += 1;
        }
        return $prefix . date("Ymd") . "-" . str_pad($max_code, 7, "0", STR_PAD_LEFT);
    }

    static function checkFully($orderItemId) {
        $itemInBag = 0;
        $orderItem = OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
        if (isset($orderItem)) {
            $orderItemInBag = OrderItemPacking::find()->where("orderItemId=" . $orderItemId)->all();
            foreach ($orderItemInBag as $inBag):
                $itemInBag += $inBag->quantity;
            endforeach;
//throw new \yii\base\Exception($orderItem->quantity . " = " . $itemInBag);
            if ($orderItem->quantity == $itemInBag) {//ครบแล้ว
                return true;
            } else {
                return false;
            }
        } else {
            return '';
        }
    }

    static function checkSuccessOrder($orderId) {
        $orderItems = OrderItem::find()->where("orderId=" . $orderId . " and DATE(DATE_SUB(sendDateTime,INTERVAL " . OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE()")->all();
        $check = 0;
        if (isset($orderItems) && !empty($orderItems)) {
            foreach ($orderItems as $item):
                $total = 0;
                $orderPack = OrderItemPacking::find()->where("orderItemId=" . $item->orderItemId)->all();
                if (isset($orderPack) && !empty($orderPack)) {
                    foreach ($orderPack as $inpack):
                        $total += $inpack->quantity;
                    endforeach;
                    if ($total != $item->quantity) {
                        $check++;
                    }
                } else {
                    $check++;
                }
            endforeach;
            if ($check == 0) {// ครบทุก orderItem แล้ว
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    static function updateOrderItem($orderItemId) {
        $orderItem = OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
        $orderItem->status = 13;
//throw new \yii\base\Exception($orderItem->orderItemId);
        $orderItem->updateDateTime = new \yii\db\Expression('NOW()');
        $orderItem->save(false);
    }

    static function updateOrder($orderId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $order->status = 13;
        $order->updateDateTime = new \yii\db\Expression('NOW()');
        $order->save(false);
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

    public function actionPrintBagLabel() {
        //throw new \yii\base\Exception('aaa');
        $header = $this->renderPartial('header');
        $content = $this->renderPartial('content', [
            'orderId' => $_GET['orderId'],
            'bagNo' => $_GET['bagNo']
        ]);
        $this->printPdf($content, $header);
    }

}
