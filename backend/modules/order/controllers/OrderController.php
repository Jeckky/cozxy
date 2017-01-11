<?php

namespace backend\modules\order\controllers;

use Yii;
use yii\helpers\Html;
use common\models\costfit\Order;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\OrderPaymentHistory;
//use kartik\mpdf\Pdf;
use common\helpers\CozxyUnity;
use common\helpers\PaymentPrint;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends OrderMasterController {

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->where("status >" . Order::ORDER_STATUS_REGISTER_USER . "")->orderBy("updateDateTime DESC"),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param string $id
     * @return mixed
     */
    public function actionView($hash) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $order = \common\models\costfit\Order::find()->where('orderId = "' . $params['id'] . '" ')
        ->one();
        return $this->render('@frontend/views/profile/purchase_order', compact('order'));
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Order();
        if (isset($_POST["Order"])) {
            $model->attributes = $_POST["Order"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["Order"])) {
            $model->attributes = $_POST["Order"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPrintPurchaseOrder($hash, $title) {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $orderId = Yii::$app->request->get('OrderNo');
        $this->layout = "payment/content";
        $this->title = 'Cozxy.com  | Order Purchase ';
        $this->subTitle = 'Home';
//        $this->subSubTitle = "Order Purchase";
        $orderId = $params['orderId'];

//echo htmlspecialchars($orderId);
//echo $orderId;
        if (isset($params['orderId'])) {
            $order = \common\models\costfit\Order::find()->where('orderId = "' . $params['orderId'] . '" ')
            ->one();
        } else {
            return $this->redirect(['profile/order']);
        }

        //$content = $this->renderPartial('purchase_order');
        $content = $this->renderPartial('@frontend/views/payment/purchase_order', compact('order'));
        //$this->actionMpdfDocument($content);
        $heading = FALSE;
        $title = FALSE;
        CozxyUnity::actionMpdfDocument($content, $heading, $title);
    }

    public function actionPrintPayIn() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout_payment = "/content";
        $this->title = 'Cozxy.com | My Profile';
        $this->subTitle = 'Home';
        $this->subSubTitle = "My Profile";

        return $this->render('payment');
    }

    public function actionPaymentHistory() {
//  throw new \yii\base\Exception($_GET['orderId']);
        if (isset($_GET['orderId'])) {
            $order = Order::find()->where("orderId='" . $_GET['orderId'] . "'")->one();
            $dataProvider = new ActiveDataProvider([
                'query' => OrderPaymentHistory::find()->where("orderId='" . Yii::$app->request->get('orderId') . "'")->orderBy("updateDateTime DESC"),
            ]);

            return $this->render('payment', [
                'dataProvider' => $dataProvider,
                'order' => $order
            ]);
        } else {
            return $this->render('@app/views/error/error');
        }
    }

    public function actionDetail2() {
        $orders = \common\models\costfit\OrderItem::find()->where("orderId=" . $_POST['orderId'] . " and status=" . $_POST['status'])->all();
        $show = '';
        $pic = '';
        $each = '';
        $thead = "<table class='table'><thead><th>No.</th><th>รูปภาพ</th><th>สินค้า</th><th>จำนวน</th><th>หน่วย</th></thead><tbody>";
        $tfoot = "</tbody></table>";
        $i = 1;
        if (isset($orders) && !empty($orders)) {
            foreach ($orders as $order):
                $product = \common\models\costfit\Product::find()->where("productId=" . $order->productId)->one();
                if (isset($product) && !empty($product)) {
                    $image = \common\models\costfit\ProductImage::find()->where("productId=" . $order->productId)->one();
                    if (isset($image) && !empty($image)) {
                        $pic = $image->image;
                        $unit = \common\models\costfit\Unit::find()->where("unitId=" . $product->unit)->one();
                        if (isset($unit) && !empty($unit)) {
                            $each = $unit->title;
                        }
                    }
                    $show = $show . "<tr><td>" . $i . "</td><td><img src='" . Yii::$app->homeUrl . $pic . "' width='100px;'/></td><td>" . $product->title . "</td><td>" . $order->quantity . "</td><td>" . $each . "</td></tr>";
                    $i++;
                }
            endforeach;
            $show = $thead . $show . $tfoot;
            return \yii\helpers\Json::encode($show);
        }
    }

    public function actionPurchaseOrder() {
        $ms = '';
        $model = Order::find()->where("status=" . Order::ORDER_STATUS_E_PAYMENT_SUCCESS)->all();
        if (!isset($model)) {
            $ms = 'ไม่มีรายการสั่งซื้อ';
            return $this->render('purchase', [
                'ms' => $ms
            ]);
        } else {
            return $this->render('purchase', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatePo() {
        $supplierId[0] = 0;
        $i = 0;
        $r = 0;
        $orderIds = [];
        if (isset($_GET['orderId']) && !empty($_GET['orderId'])) {
            $orders = $_GET['orderId'];
            foreach ($orders as $orderId):
                $checkStatus = false;
                $checkStatus = $this->checkOrderStatus($orderId);
                if ($checkStatus == true) {
                    $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->all();
                    foreach ($orderItems as $orderItem):
                        $flag = false;
                        $flag = $this->checkDupplicateId($supplierId, $orderItem->supplierId);
                        if ($flag == true) {
                            $supplierId[$i] = $orderItem->supplierId; //ได้ supplierId
                            $i++;
                        }
                    endforeach;
                    $order = Order::find()->where("orderId=" . $orderId)->one();
                    $order->status = Order::ORDER_STATUS_CREATEPO;
                    $order->updateDateTime = new \yii\db\Expression('NOW()');
                    $order->save(false);
                    $orderIds[$r] = $orderId;
                    $r++;
                }
            endforeach;
            if (isset($orderIds) && !empty($orderIds)) {
                $storeProductGroupId = $this->saveStoreProduct($orderIds, $supplierId);
                $header = $this->renderPartial('header');
                $content = $this->renderPartial('content', [
                    'storeProductGroupId' => $storeProductGroupId,
                ]);
                $this->printPdf($content, $header);
            } else {
                $ms = '';
                $model = Order::find()->where("status=" . Order::ORDER_STATUS_E_PAYMENT_SUCCESS)->all();
                if (!isset($model)) {
                    $ms = 'ไม่มีรายการสั่งซื้อ';
                    return $this->render('purchase', [
                        'ms' => $ms
                    ]);
                } else {
                    return $this->render('purchase', [
                        'model' => $model,
                    ]);
                }
            }
        } else {
            $ms = '';
            $model = Order::find()->where("status=" . Order::ORDER_STATUS_E_PAYMENT_SUCCESS)->all();
            if (!isset($model)) {
                $ms = 'ไม่มีรายการสั่งซื้อ';
                return $this->render('purchase', [
                    'ms' => $ms
                ]);
            } else {
                return $this->render('purchase', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionReprintPo() {
        $storeProductGroup = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId=" . $_GET['storeProductGroupId'])->one();
        $header = $this->renderPartial('header', ['ms' => 'Reprint']);
        $content = $this->renderPartial('content2', [
            'storeProductGroup' => $storeProductGroup
        ]);
        $this->printPdf($content, $header);
    }

    public function actionRealTime() {
        echo '<table class="table">';
        echo '<tr style="height: 50px;background-color: #F0FFFF;">';
        echo '<th style="vertical-align: middle;text-align: center;width: 10%;">ลำดับที่</th>';
        echo '<th style="vertical-align: middle;text-align: center;width: 30%;">Order Invoice.</th>';
        echo '<th style="vertical-align: middle;text-align: center;width: 15%;">จำนวนรายการ</th>';
        echo '<th style="vertical-align: middle;text-align: center;width: 30%;">สถานะ</th>';
        echo '</tr>';
        $model = Order::find()->where("status=" . Order::ORDER_STATUS_E_PAYMENT_SUCCESS)->all();
        if (isset($model) && !empty($model)) {
            $i = 1;
            $a = 0;
            foreach ($model as $order):

                echo '<tr>';
                echo '<td style="vertical-align: middle;text-align: center;width: 5%;">' . $i . '</td>';
                echo '<td style = "vertical-align: middle;text-align: center;width: 30%;">' . $order->invoiceNo . '</td>';
                echo '<td style="vertical-align: middle;text-align: center;width: 15%;">' . Order::countOrderItem($order->orderId) . ' รายการ</td>';
                echo '<td style = "vertical-align: middle;text-align: center;width: 15%;">' . $order->getStatusText($order->status) . '</td>';
                echo '</tr>';
                $orderId[$a] = $order->orderId;
                $a++;
                $i++;
            endforeach;
        }else {
            echo '<tr><td colspan="5" style="text-align: center; background-color: #cccccc;"><h4> ไม่มีข้อมูล</h4></td></tr>';
        }
        echo '<table>';
        if (isset($model) && !empty($model)) {
            echo '<div class="pull-right">' . Html::a('<i class="fa fa-check-square-o" aria-hidden="true">  สร้างใบ PO</i>', ['create-po', 'orderId' => $orderId], ['class' => 'btn btn-lg btn-success pono', 'target' => '_blank']) . '</div>';
        }
    }

    public function actionReprintRealTime() {
        $show = '<table class="table" >' .
        '<tr style="height: 50px;background-color: #ffffcc;">' .
        '<th style="vertical-align: middle;text-align: center;width: 10%;">ลำดับที่</th>' .
        '<th style="vertical-align: middle;text-align: center;width: 30%;">PO NO.</th>' .
        '<th style="vertical-align: middle;text-align: center;width: 15%;">วันที่สร้าง</th>' .
        '<th style="vertical-align: middle;text-align: center;width: 30%;">สถานะ</th>' .
        '<th style="vertical-align: middle;text-align: center;width: 30%;">พิมพ์ซ้ำ</th>' .
        '</tr>';
        $poes = \common\models\costfit\StoreProductGroup::allPurchaseOrder();

        if (isset($poes) && !empty($poes)) {
            $i = 1;
            $a = 0;
            $orderId = [];
            foreach ($poes as $po):

                $show = $show . '<tr>' .
                ' <td style="vertical-align: middle;text-align: center;width: 5%;">' . $i . '</td>' .
                '<td style="vertical-align: middle;text-align: center;width: 30%;">' . $po->poNo . '</td>' .
                '<td style="vertical-align: middle;text-align: center;width: 15%;">' . $this->dateThai($po->createDateTime, 1) . '</td>' .
                '<td style="vertical-align: middle;text-align: center;width: 15%;">' . \common\models\costfit\StoreProductGroup::getStatusText($po->status) . '</td>' .
                '<td style="vertical-align: middle;text-align: center;width: 15%;">' . Html::a('<i class = "fa fa-print" aria-hidden = "true"></i> พิมพ์ซ้ำ', ['reprint-po', 'storeProductGroupId' => $po->storeProductGroupId], ['class' => 'btn btn-md btn-warning pono', 'target' => '_blank']) . '</td>' .
                '</tr>';
                $i++;
            endforeach;
        } else {

            $show = $show . '<tr><td colspan = "5" style = "text-align: center; background-color: #cccccc;"><h4> ไม่มีข้อมูล</h4></td></tr>';
        }

        $show = $show . '</table>';
        return $show;
    }

    public static function checkDupplicateId($array, $newIndex) {
        $check = 0;
//throw new \yii\base\Exception(print_r($array, true));
        foreach ($array as $old):
            if ($old == $newIndex) {
                $check++;
            }

        endforeach;
        if ($check == 0) {
            return true;
        } else {
            return false;
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

    public static function checkOrderStatus($orderId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (isset($order) && !empty($order)) {
            if ($order->status == Order::ORDER_STATUS_E_PAYMENT_SUCCESS) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function saveStoreProduct($orders, $supplierId) {
        $storeProductGroupId = [];
        $i = 0;
        foreach ($supplierId as $suppId):
            $storeProductGroup = new \common\models\costfit\StoreProductGroup();
            $storeProductGroup->supplierId = $suppId;
            $storeProductGroup->poNo = \common\models\costfit\StoreProductGroup::genPoNo();
            $storeProductGroup->summary = \common\models\costfit\OrderItem::summarySupplier($suppId, $orders);
            $storeProductGroup->createDateTime = new \yii\db\Expression('NOW()');
            $storeProductGroup->updateDateTime = new \yii\db\Expression('NOW()');
            $storeProductGroup->save(false);
            $lastStoreProductGroupId = Yii::$app->db->getLastInsertID();
            $storeProductGroupId[$i] = $lastStoreProductGroupId;
            $productSuppId = \common\models\costfit\OrderItem::supplierItems($suppId, $orders);
            foreach ($productSuppId as $pSuppId):
                $storeProducts = new \common\models\costfit\StoreProduct();
                $storeProducts->storeProductGroupId = $lastStoreProductGroupId;
                $storeProducts->productSuppId = $pSuppId;
                $storeProducts->productId = \common\models\costfit\ProductSuppliers::productSupplierName($pSuppId)->productId;
                $storeProducts->storeId = 1;
                $storeProducts->paletNo = 1;
                $storeProducts->quantity = \common\models\costfit\OrderItem::totalSupplierItem($suppId, $pSuppId, $orders);
                $storeProducts->price = \common\models\costfit\ProductSuppliers::productPriceSupplier($pSuppId);
                $storeProducts->total = $storeProducts->price * $storeProducts->quantity;
                $storeProducts->createDateTime = new \yii\db\Expression('NOW()');
                $storeProducts->updateDateTime = new \yii\db\Expression('NOW()');
                $storeProducts->save(false);
            endforeach;
            $i++;
        endforeach;
        return $storeProductGroupId;
    }

}
