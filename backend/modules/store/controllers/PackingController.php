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
        ->where("DATE(DATE_SUB(oi.sendDateTime,INTERVAL " . \common\models\costfit\OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() AND (`order`.status = " . \common\models\costfit\Order::ORDER_STATUS_PICKED . " OR `order`.status =" . \common\models\costfit\Order::ORDER_STATUS_PACKED . " )")
        ->orderBy("`order`.status ASC");


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (isset($_GET['orderNo']) && !empty($_GET['orderNo'])) {
            $order = \common\models\costfit\Order::find()->where("orderNo='" . $_GET['orderNo'] . "'")->one();
            if (isset($order) && !empty($order)) {
                return $this->render('show-orders', [
                    'orderId' => $order->orderId,
                ]);
            } else {
                return $this->render('index', [
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionPacking()
    {
        $ms = '';
        if (isset($_GET['item'])) {
            $order = \common\models\costfit\Order::find()->where("orderId=" . $_GET['orderId'])->one();
            $productId = \common\models\costfit\Product::findProductId($_GET['item']);
            if (isset($order)) {
                if (isset($productId) && !empty($productId)) {
                    $items = \common\models\costfit\OrderItem::find()->where("orderId=" . $order->orderId . " and productId=" . $productId)->one();
                    if (isset($items) && !empty($items)) {
                        $packingItems = \common\models\costfit\OrderItemPacking::find()->where("orderItemId=" . $items->orderItemId . " and status=99")->one();
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

    public function actionCloseBag()
    {
        $ms = '';
        $full = 0;
        if (isset($_GET['orderId']) && !empty($_GET['orderId'])) {
            $itemInBag = $this->findItemInBag($_GET['orderId']);
            //throw new \yii\base\Exception($itemInBag);
            if (!empty($itemInBag)) {
                $inBags = \common\models\costfit\OrderItemPacking::find()->where("orderItemId in($itemInBag) and status=99")->all();

                if (count($inBags) > 0) {
                    $bagNo = $this->genBagNo();
                } else {
                    $bagNo = $this->genBagNo(true);
                }
                foreach ($inBags as $inBag):
                    $inBag->status = 4;
                    $inBag->bagNo = $bagNo;
                    $inBag->updateDateTime = new \yii\db\Expression('NOW()');
                    $inBag->save(false);
                    $fully = $this->checkFully($inBag->orderItemId); //เชคว่า item ครบตาม order หรือมั๊ย
                    if ($fully == false) {//ถ้ายังไม่ครบทุก item
                        $full++;
                    } else {
                        //throw new \yii\base\Exception($inBag->orderItemId);
                        $this->updateOrderItem($inBag->orderItemId);
                    }
                endforeach;

//                echo "<script>window.open('" . Yii::$app->homeUrl . "store/packing/print-bag-label?orderId=" . $_GET['orderId'] . "&bagNo=" . $bagNo . "', '_blank');
//                        window.focus();</script>";


                if ($full > 0) {//ถ้ายังไม่ครบทุก item กลับไปหน้าสแกนโปรดักใส่ถุง (เปิดถุงใหม่)
                    return $this->render('show-orders', [
                        'orderId' => $_GET['orderId'],
                        'ms' => $ms,
                        'bagNo' => $bagNo
                    ]);
                } else {//กลับไปหน้า index เพื่อ เลือก order ถัดไป
                    $this->updateOrder($_GET['orderId']);
                    $query = \common\models\costfit\Order::find()
                    ->join("LEFT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
                    ->where("DATE(DATE_SUB(oi.sendDateTime,INTERVAL " . \common\models\costfit\OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() AND `order`.status = " . \common\models\costfit\Order::ORDER_STATUS_PICKED);

                    $dataProvider = new ActiveDataProvider([
                        'query' => $query,
                    ]);

                    return $this->render('index', [
                        'dataProvider' => $dataProvider,
                        'bagNo' => $bagNo,
                        'orderId' => $_GET["orderId"]
                    ]);
                }
            } else {
                $ms = 'ไม่มีสินค้าในถุง';
                return $this->render('show-orders', [
                    'orderId' => $_GET['orderId'],
                    'ms' => $ms
                ]);
            }
        } else {
            return $this->render('show-orders', [
                'orderId' => $_GET['orderId'],
                'ms' => $ms
            ]);
        }
    }

    public function actionRemove()
    {
        if (isset($_GET['packingId'])) {
            $itemPacking = \common\models\costfit\OrderItemPacking::find()->where("orderItemPackingId=" . $_GET['packingId'])->one();
            $itemPacking->delete();
            return $this->render('show-orders', [
                'orderId' => $_GET['orderId'],
                'ms' => $_GET['ms']
            ]);
        }
    }

    public function actionMinus()
    {
        if (isset($_GET['packingId'])) {
            $itemPacking = \common\models\costfit\OrderItemPacking::find()->where("orderItemPackingId=" . $_GET['packingId'])->one();
            $itemPacking->quantity = $itemPacking->quantity - 1;
            $itemPacking->save(false);
            return $this->render('show-orders', [
                'orderId' => $_GET['orderId'],
                'ms' => $_GET['ms']
            ]);
        }
    }

    static function checkSum($orderItemId, $orderQuantity)
    {
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

    static function findItemInBag($orderId)
    {
        $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->all();
        $items = '';
        if (isset($orderItems) && !empty($orderItems)) {
            foreach ($orderItems as $orderItem):
                $items = $items . $orderItem->orderItemId . ",";
            endforeach;
            $items = substr($items, 0, -1);
        }
        return $items;
    }

    static function genBagNo($getLast = FALSE)
    {
        $prefix = 'BG'; //$supplierModel->prefix;
        $order = \common\models\costfit\OrderItemPacking::find()->where("substr(bagNo,1,2)='" . $prefix . "' order by bagNo DESC ")->one();
        //throw new \yii\base\Exception($order->bagNo);
        $max_code = isset($order) ? $order->bagNo : '0000000';
        $max_code = substr($max_code, -7);
        if (!$getLast) {
            $max_code += 1;
        }
        return $prefix . date("Ymd") . "-" . str_pad($max_code, 7, "0", STR_PAD_LEFT);
    }

    static function checkFully($orderItemId)
    {
        $itemInBag = 0;
        $orderItem = \common\models\costfit\OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
        if (isset($orderItem)) {
            $orderItemInBag = \common\models\costfit\OrderItemPacking::find()->where("orderItemId=" . $orderItemId)->all();
            foreach ($orderItemInBag as $inBag):
                $itemInBag+=$inBag->quantity;
            endforeach;
            //throw new \yii\base\Exception($orderItem->quantity . " = " . $itemInBag);
            if ($orderItem->quantity == $itemInBag) {
                return true;
            } else {
                return false;
            }
        } else {
            return '';
        }
    }

    static function updateOrderItem($orderItemId)
    {
        $orderItem = \common\models\costfit\OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
        $orderItem->status = 6;
        //throw new \yii\base\Exception($orderItem->orderItemId);
        $orderItem->updateDateTime = new \yii\db\Expression('NOW()');
        $orderItem->save(false);
    }

    static function updateOrder($orderId)
    {
        $order = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->one();
        $order->status = 13;
        $order->updateDateTime = new \yii\db\Expression('NOW()');
        $order->save(false);
    }

    static function printPdf($content, $header)
    {
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

    public function actionPrintBagLabel()
    {
        $header = $this->renderPartial('header');
        $content = $this->renderPartial('content', [
            'orderId' => $_GET['orderId'],
            'bagNo' => $_GET['bagNo']
        ]);
//                throw new \yii\base\Exception(111);
        $this->printPdf($content, $header);
    }

}
