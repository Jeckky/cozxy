<?php

namespace mobile\modules\v1\controllers;

use mobile\modules\v1\models\Product;
use mobile\modules\v1\models\ProductSuppliers;
use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use common\models\costfit\Order;
use common\models\costfit\OrderItem;
use common\helpers\Token;
use yii\db\Expression;
use yii\base\Exception;
use frontend\controllers\CartController as CartFrontendController;
use common\models\costfit\PaymentMethod;

/**
 * Default controller for the `mobile` module
 */
class CartController extends CartFrontendController
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $res = [];
        $userId = isset(Yii::$app->user->id) ? Yii::$app->user->id : 43;

        $orderModel = Order::find()->where(['userId'=>$userId])->one();
        $res['orderId'] = $orderModel->orderId;
        $res['orderNo'] = $orderModel->orderNo;
        $res['totalExVat'] = $orderModel->totalExVat;
        $res['vat'] = $orderModel->vat;
        $res['total'] = $orderModel->total;
        $res['grandTotal'] = $orderModel->grandTotal;
        $res['shippingRate'] = $orderModel->shippingRate;
        $res['summary'] = $orderModel->summary;

        $res['items'] = [];
        $i = 0;

        foreach($orderModel->orderItems as $orderItem) {
            $item = [
                'title'=>isset($orderItem->product->title) ?$orderItem->product->title:$orderItem->productSupplier->title,
            ];

            $res['items'][$i]  = array_merge($orderItem->attributes, $item);

            $i++;
        }

        return Json::encode($res);
    }

    public function actionAddCartItem()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $productId = $contents['productId'];
        $productSuppId = $contents['productSuppId'];
        $quantity = $contents["quantity"];
        $receiveType = $contents['receiveType'];

        $productSupplierModel = ProductSuppliers::findOne($productSuppId);

        $res = [];
        $order = Order::getOrder();
        if(!isset($order)) {
            $order = new Order();
            $order->token = Token::getToken();
            $order->status = Order::ORDER_STATUS_DRAFT;
            $order->createDateTime = new Expression("NOW()");
            $order->paymentType = PaymentMethod::TYPE_CREDIT_CARD;
            if(!$order->save(FALSE)) {
                throw new Exception("Can't Save Order");
            }
        }
        $fastid = '';
        if($fastid == '') {
            $orderItem = OrderItem::find()->where("orderId = " . $order->orderId . " AND productSuppId =" . $productSuppId . "")->one();
        } else {
            $orderItem = OrderItem::find()->where("orderId = " . $order->orderId . " AND productSuppId =" . $productSuppId . "" . " and sendDate=" . $fastid)->one();
        }

        if(!isset($orderItem)) {
            $orderItem = new OrderItem();
            $orderItem->quantity = $quantity;
        } else {
            $orderItem->quantity = $orderItem->quantity + $quantity;
        }

        /*
          ตรวจสอบจำนวนสินค้าคงเหลือ
         */
        if(isset($productId)) {
            $Qty = ProductSuppliers::find()->where('productId=' . $productId . ' and productSuppId=' . $productSuppId)->one();
            $quantityMain = $Qty->result;

            if((int)$orderItem->quantity > (int)$quantityMain) {
                $res["isMaxQuantitys"] = 'NO';
                $res["status"] = FALSE;

                return Json::encode($res);
            } else {
                $res["status"] = TRUE;
                $res["isMaxQuantitys"] = 'YES';
            }
        }

        $product = new Product();
        $orderItem->sendDate = $fastid;
        $orderItem->firstTimeSendDate = $fastid;
        $orderItem->supplierId = $productSupplierModel->userId;
        $orderItem->orderId = $order->orderId;
        $orderItem->productId = $productId;
        $orderItem->productSuppId = $productSuppId;
        $orderItem->receiveType = $receiveType;
        $productPrice = $product->calProductPrice($orderItem->productSuppId, $orderItem->quantity, 1, $fastid, NULL);
        $orderItem->priceOnePiece = $orderItem->product->calProductPrice($orderItem->productSuppId, 1, 0, NULL, NULL);
        $orderItem->price = $productPrice["price"];
        $orderItem->subTotal = $orderItem->quantity * $orderItem->price;
        $orderItem->discountValue = isset($productPrice["discountValue"]) ? $productPrice["discountValue"] : 0;
        if(isset($productPrice["shippingDiscountValue"])) {
            $orderItem->shippingDiscountValue = $productPrice["shippingDiscountValue"];
            $orderItem->total = ($orderItem->quantity * $orderItem->price) - $orderItem->discountValue - $productPrice["shippingDiscountValue"];
        } else {
            $orderItem->total = ($orderItem->quantity * $orderItem->price) - $orderItem->discountValue;
        }

        $orderItem->createDateTime = new Expression("NOW()");
        if($orderItem->save()) {
            if(Yii::$app->db->lastInsertID > 0) {
                $orderItemId = Yii::$app->db->lastInsertID;
            } else {
                $orderItemId = $orderItem->orderItemId;
            }
            $order->save();

            $res["status"] = TRUE;
            $res["shoppingCart"] = $this->createShoppingCart($order->orderId);
            $res["orderItemId"] = $orderItemId;
            $cartArray = Order::findCartArray();
            $res["cart"] = $cartArray;
            $pQuan = 0;
            foreach($cartArray["items"] as $item) {
                if($item["productSuppId"] == $productId) {
                    $pQuan += $item["qty"];
                }
            }
            $product = new Product();
            $maxQuantity = $product->findMaxQuantity($productSuppId);
            if($pQuan >= $maxQuantity) {
                $res["isMaxQuantity"] = TRUE;
            } else {
                $res["isMaxQuantity"] = FALSE;
            }
        } else {
            $res["status"] = FALSE;
            $res["error"] = $orderItem->errors;
        }

        return Json::encode($res);
    }

    public function actionDeleteCartItem()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $id = $contents["orderItemId"];
        $res = [];
        $orderItem = OrderItem::findOne($id);
        $qnty = intval($orderItem->quantity);
        $orderId = $orderItem->orderId;

        if(OrderItem::deleteAll("orderItemId = $id") > 0) {
            $res["status"] = TRUE;
            $order = Order::find()->where("orderId=" . $orderId)->one();
            $order->save(); // Save For Cal new total
            $cartArray = Order::findCartArray();
            $res["cart"] = $cartArray;
            $res["productSuppId"] = $orderItem->productSuppId;
            $res["deleteQnty"] = $qnty;
            $orderItems = OrderItem::find()->where("orderId = " . $orderId)->all();
            if(isset($orderItems) && count($orderItems) > 0) {
                $res["showCheckout"] = "yes";
            } else {
                $res["showCheckout"] = "no";
            }
        } else {
            $res["status"] = FALSE;
        }

        return Json::encode($res);
    }
}
