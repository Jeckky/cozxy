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
        $returnList = ReturnProduct::find()->where("orderId=" . $orderId . " and status=1")->all();
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
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $productSuppId = $this->supplierId($_POST["isbn"], $_POST["orderId"]);

        if ($productSuppId != '') {
            $productSuppId = trim($productSuppId);
            $producSupp = ProductSuppliers::find()->where("isbn='" . $_POST["isbn"] . "' and productSuppId=" . $productSuppId)->one();
            if (isset($producSupp) && !empty($producSupp)) {
                $orderItems = OrderItem::find()->where("productSuppId=" . $producSupp->productSuppId . " and orderId=" . $_POST["orderId"])->all();
                if (isset($orderItems) && !empty($orderItems)) {
                    $header = $this->tableHeader();
                    foreach ($orderItems as $item):
                        $returns = new ReturnProduct();
                        $returns->orderId = $_POST["orderId"];
                        $returns->orderItemId = $item->orderItemId;
                        $returns->discount = OrderItem::calculateReturnDiscount($item->orderItemId);
                        $returns->productSuppId = $item->productSuppId;
                        $returns->quantity = 1;
                        $returns->price = ProductSuppliers::productPrice($item->productSuppId);
                        $returns->totalPrice = $returns->quantity * $returns->price;
                        $returns->totalDiscount = $returns->discount * $returns->quantity;
                        $returns->credit = $returns->totalPrice - $returns->totalDiscount;
                        $returns->receiver = Yii::$app->user->identity->userId;
                        $returns->status = 1;
                        $returns->createDateTime = new \yii\db\Expression('NOW()');
                        $returns->updateDateTime = new \yii\db\Expression('NOW()');
                        $returns->save(false);
                    endforeach;
                    $returnItems = ReturnProduct::find()->where("orderId=" . $_POST["orderId"] . " and status=1")->all();
                    $i = 1;
                    foreach ($returnItems as $rItem):
                        $producSupp = ProductSuppliers::find()->where("productSuppId=" . $rItem->productSuppId)->one();
                        $body = $body . '<tr style="height: 50px;">' . '<td style="vertical-align: middle;text-align: center;">' . $i . '</td>' .
                                '<td style="vertical-align: middle;text-align: center;"><img src="' . $baseUrl . '/' . ProductSuppliers::productImagesSuppliers($rItem->productSuppId)[0]->image . '" style="width:150px;height: 100px;"><br>'
                                . $producSupp->title . '</td>' .
                                '<td style="vertical-align: middle;text-align: center;">' . $rItem->quantity . '</td>' .
                                '<td style="vertical-align: middle;text-align: center;"><a class="btn" id="incr-return">-</a> <input type="text" class="text-center" id="qnty-return' . $rItem->returnProductId . '" value="' . $rItem->quantity . '" style="width:35px;height:35px;" readonly="true"> <a class="btn" id="incr-return">+</a></td>' .
                                '<td style="vertical-align: middle;text-align: center;"><textarea name="remark[' . $rItem->returnProductId . ']" id="remark' . $rItem->returnProductId . '">' . $rItem->remark . '</textarea></td>' .
                                '<input type="hidden" id="pSuppId" value="' . $rItem->returnProductId . '">' .
                                '<input type="hidden" id="pOrderId" value="' . $rItem->orderId . '">' .
                                '<td style="vertical-align: middle;text-align: center;font-size:25pt;"><i class="fa fa-times-circle deleteR" id="deleteR"' . $rItem->returnProductId . '" aria-hidden="true" style="cursor: pointer;"></i></td>' .
                                '</tr>';
                        $i++;
                    endforeach;
                    $footer = $this->tableFooter();
                    $res["dataList"] = $header . $body . $footer;
                    $res["errors"] = '1';
                } else {
                    $res["errors"] = "Product not found in this order";
                }
            } else {
                $res["errors"] = "Product not found";
            }
        } else {
            $res["errors"] = "Product not found";
        }

        return \yii\helpers\Json::encode($res);
    }

    public function actionConfirmReturn() {
        if (isset($_POST["orderId"])) {
            $orderId = $_POST["orderId"];
            //throw new \yii\base\Exception(print_r($_POST["remark"], true));
            if (isset($_POST["remark"]) && !empty($_POST["remark"])) {
                foreach ($_POST["remark"] as $returnProductId => $remark):
                    $returnProduct = ReturnProduct::find()->where("returnProductId=" . $returnProductId)->one();
                    $returnProduct->remark = $remark;
                    $returnProduct->updateDateTime = new \yii\db\Expression('NOW()');
                    $returnProduct->save(false);
                endforeach;
            }
            $returnProducts = ReturnProduct::find()->where("orderId=" . $orderId)->all();
            if (isset($returnProducts) && !empty($returnProducts)) {
                return $this->render('confirm_return', [
                            'orderId' => $orderId,
                            'returnProducts' => $returnProducts]);
            }
        }
        if (isset($_POST['confirm'])) {
            $orderId = $_POST['confirm'];
            $returnProduct = ReturnProduct::find()->where("orderId=" . $orderId . " and status=1")->all();
        }
    }

    public function actionDeleteReturnList() {
        $res = [];
        $body = '';
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $returnProductId = $_POST["returnId"];
        $returnProduct = ReturnProduct::find()->where("returnProductId=" . $returnProductId)->one();
        if (isset($returnProduct) && !empty($returnProduct)) {
            $returnProduct->delete();
            $items = count(ReturnProduct::find()->where("orderId=" . $_POST['pOrderId'])->all());
            if ($items > 0) {
                $header = $this->tableHeader();
                $returnItems = ReturnProduct::find()->where("orderId=" . $_POST["pOrderId"])->all();
                $i = 1;
                foreach ($returnItems as $rItem):
                    $producSupp = ProductSuppliers::find()->where("productSuppId=" . $rItem->productSuppId)->one();
                    $body = $body . '<tr style="height: 50px;">' . '<td style="vertical-align: middle;text-align: center;">' . $i . '</td>' .
                            '<td style="vertical-align: middle;text-align: center;"><img src="' . $baseUrl . '/' . ProductSuppliers::productImagesSuppliers($rItem->productSuppId)[0]->image . '" style="width:150px;height: 100px;"><br>'
                            . $producSupp->title . '</td>' .
                            '<td style="vertical-align: middle;text-align: center;">' . $rItem->quantity . '</td>' .
                            '<td style="vertical-align: middle;text-align: center;"><a class="btn" id="incr-return">-</a> <input type="text" class="text-center" id="qnty-return' . $rItem->returnProductId . '" value="' . $rItem->quantity . '" style="width:35px;height:35px;" readonly="true"> <a class="btn" id="incr-return">+</a></td>' .
                            '<td style="vertical-align: middle;text-align: center;"><textarea name="remark[' . $rItem->returnProductId . ']" id="remark' . $rItem->returnProductId . '">' . $rItem->remark . '</textarea></td>' .
                            '<input type="hidden" id="pSuppId" value="' . $rItem->returnProductId . '">' .
                            '<input type="hidden" id="pOrderId" value="' . $rItem->orderId . '">' .
                            '<td style="vertical-align: middle;text-align: center;font-size:25pt;"><i class="fa fa-times-circle deleteR" id="deleteR"' . $rItem->returnProductId . '" aria-hidden="true" style="cursor: pointer;"></i></td>' .
                            '</tr>';
                    $i++;
                endforeach;
                $footer = $this->tableFooter();
                $res["dataList"] = $header . $body . $footer;
                $res["status"] = TRUE;
            }else {
                $res["status"] = FALSE;
            }
        }

        return \yii\helpers\Json::encode($res);
    }

    public function actionCheckRemark() {
        $orderId = $_POST['orderId'];
        $res = [];
        $id = [];
        $i = 0;
        $returnProduct = ReturnProduct::find()->where("orderId=" . $orderId . " and status=1")->all();
        if (isset($returnProduct) && !empty($returnProduct)) {
            foreach ($returnProduct as $return):
                $id[$i] = $return->returnProductId;
                $i++;
            endforeach;
            $res["status"] = TRUE;
            $res["returnId"] = $id;
            $res["counts"] = count(ReturnProduct::find()->where("orderId=" . $orderId . " and status=1")->all());
            // echo $orderId;
            // throw new \yii\base\Exception($orderId);
        }else {
            $res["status"] = FALSE;
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionChangeQuantityReturnList() {
        $orderId = $_POST["orderId"];
        $returnId = $_POST["returnId"];
        $currentQnty = $_POST["qnty"];
        $type = $_POST["incr"];
        $res = [];
        if ($type == "+") {
            $newQuantity = $currentQnty + 1;
        } else {
            $newQuantity = $currentQnty - 1;
        }
        $return = ReturnProduct::find()->where("returnProductId=" . $returnId)->one();
        $orderItem = OrderItem::find()->where("orderItemId=" . $return->orderItemId . " and orderId=" . $orderId)->one();
        if ($newQuantity <= 0) {
            $res["quantity"] = 1;
            $res["messege"] = "จำนวนที่ต้องการคืนต้องไม่น้อยกว่า 1 รายการ";
            $res["status"] = FALSE;
        } else if ($newQuantity > $orderItem->quantity) {
            $res["quantity"] = $orderItem->quantity;
            $res["messege"] = "จำนวนที่ต้องการคืนต้องไม่มากกว่าจำนวนที่ซื้อ(" . $orderItem->quantity . " รายการ)";
            $res["status"] = FALSE;
        } else {
            $res["quantity"] = $newQuantity;
            $res["status"] = TRUE;
        }
        $return->quantity = $res["quantity"];
        $return->totalPrice = $res["quantity"] * $return->price;
        $return->totalDiscount = $return->discount * $res["quantity"];
        $return->credit = $return->totalPrice - $return->totalDiscount;
        $return->save(false);
        return \yii\helpers\Json::encode($res);
    }

    public function supplierId($isbn, $orderId) {
        $id = OrderItem::find()
                ->join("LEFT JOIN", "product_suppliers ps", "order_item.productSuppId=ps.productSuppId")
                ->where("ps.isbn='" . $isbn . "' and order_item.orderId=" . $orderId)
                ->one();
        if (isset($id) && !empty($id)) {
            return $id->productSuppId;
        } else {
            return '';
        }
    }

    public function tableHeader() {
        return $header = '<table class="table">' .
                '<tr style="height: 50px;background-color: #999999;">' .
                '<th style="vertical-align: middle;text-align: center;width: 5%;">No.</th>' .
                '<th style="vertical-align: middle;text-align: center;width: 30%;">สินค้า</th>' .
                '<th style="vertical-align: middle;text-align: center;width: 10%;">สั่งซื้อ</th>' .
                '<th style="vertical-align: middle;text-align: center;width: 35%;">จำนวนที่ต้องการคืน</th>' .
                '<th style="vertical-align: middle;text-align: center;width: 15%;">Remark</th>' .
                '<th style="vertical-align: middle;text-align: center;width: 5%;">ยกเลิก</th>' .
                '</tr>';
    }

    public function tableFooter() {
        return $footer = '</table>' . '<a class="btn-lg  pull-right" id="confirm-return" style="background-color: #000;color: #ffcc00;cursor: pointer;"><i class="fa fa-check-square-o" aria-hidden="true"></i> คืนสินค้า</a>';
    }

}
