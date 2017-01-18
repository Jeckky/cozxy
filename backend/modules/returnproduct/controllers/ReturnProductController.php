<?php

namespace backend\modules\returnproduct\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;
use common\models\costfit\Address;
use common\models\costfit\User;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItem;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ReturnProduct;

/**
 * Default controller for the `returnProduct` module
 */
class ReturnProductController extends ReturnProductMasterController {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        if (isset($_POST['orderNo']) && !empty($_POST['orderNo'])) {
            $order = Order::find()->where("orderNo='" . $_POST['orderNo'] . "'")->one();
            if (isset($order) && !empty($order)) {
                return $this->redirect(['order-detail',
                            'orderId' => $order->orderId
                ]);
            } else {
                $ms = 'ไม่มีออร์เดอร์ ' . $_POST['orderNo'] . ' กรุณาลองใหม่อีกครั้ง';
                return $this->render('index', [
                            'ms' => $ms]);
            }
        } else {
            return $this->render('index');
        }
    }

    public function actionOrderDetail($orderId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $addressText = '';
        $returnList = ReturnProduct::find()->where("orderId=" . $orderId)->all();
        $address = Address::find()->where("userId=" . $order->userId . " and isDefault=1")->one();
        if (isset($address) && !empty($address)) {
            $addressText = User::userAddressText($address->addressId);
        }
        $pickingPoint = PickingPoint::find()->where("pickingId=" . $order->pickingId)->one();
        return $this->render('order_detail', [
                    'order' => $order,
                    'addressText' => $addressText,
                    'pickingPoint' => isset($pickingPoint) && !empty($pickingPoint) ? $pickingPoint->title : '',
                    'returnList' => $returnList
        ]);
    }

    public function actionReturnList() {
        $res = [];
        $body = '';
        $producSupp = ProductSuppliers::find()->where("isbn='" . $_POST["isbn"] . "'")->one();
        if (isset($producSupp) && !empty($producSupp)) {
            $orderItems = OrderItem::find()->where("productSuppId=" . $producSupp->productSuppId . " and orderId=" . $_POST["orderId"])->all();
            if (isset($orderItems) && !empty($orderItems)) {
                $header = '<table class="table">' .
                        '<tr style="height: 50px;background-color: #999999;">' .
                        '<th style="vertical-align: middle;text-align: center;width: 10%;">ลำดับที่</th>' .
                        '<th style="vertical-align: middle;text-align: center;width: 30%;">สินค้า</th>' .
                        '<th style="vertical-align: middle;text-align: center;width: 15%;">จำนวนที่สั่งซื้อ</th>' .
                        '<th style="vertical-align: middle;text-align: center;width: 35%;">จำนวนที่ต้องการคืน</th>' .
                        '<th style="vertical-align: middle;text-align: center;width: 10%;">ยกเลิก</th>' .
                        '</tr>';
                foreach ($orderItems as $item):
                    $returns = new ReturnProduct();
                    $returns->orderId = $_POST["orderId"];
                    $returns->orderItemId = $item->orderItemId;
                    $returns->productSuppId = $item->productSuppId;
                    $returns->quantity = 1;
                    $returns->price = ProductSuppliers::productPrice($item->productSuppId);
                    $returns->receiver = Yii::$app->user->identity->userId;
                    $returns->status = 1;
                    $returns->createDateTime = new \yii\db\Expression('NOW()');
                    $returns->updateDateTime = new \yii\db\Expression('NOW()');
                    $returns->save(false);
                endforeach;
                $returnItems = ReturnProduct::find()->where("orderId=" . $_POST["orderId"])->all();
                $i = 1;
                foreach ($returnItems as $rItem):
                    $body = $body . '<tr style="height: 50px;">' . '<td style="vertical-align: middle;text-align: center;">' . $i . '</td>' .
                            '<td style="vertical-align: middle;text-align: center;">' . $producSupp->title . '</td>' .
                            '<td style="vertical-align: middle;text-align: center;">' . $rItem->quantity . '</td>' .
                            '<td style="vertical-align: middle;text-align: center;"><button class="btn-md"> - </button> <input type="text" class="text-center" style="width:35px;height:35px;"> <button class="btn-md"> + </button></td>' .
                            '<td style="vertical-align: middle;text-align: center;font-size:25pt;"><i class="fa fa-times-circle" id="deleteR' . $rItem->returnProductId . '" aria-hidden="true" style="cursor: pointer;"></i></td>' .
                            '</tr>';
                    $i++;
                endforeach;
                $footer = '<table>';
                $res["dataList"] = $header . $body . $footer;
                $res["errors"] = '1';
            } else {
                $res["errors"] = "Product not found in this order";
            }
        } else {
            $res["errors"] = "Product not found";
        }

        return \yii\helpers\Json::encode($res);
    }

}
