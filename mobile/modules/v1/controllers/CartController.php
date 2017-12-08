<?php

namespace mobile\modules\v1\controllers;

use mobile\modules\v1\models\Product;
use common\models\costfit\ProductSupplier;
use Yii;
use yii\web\Controller;
use Json;
use common\models\costfit\Order;
use common\models\costfit\OrderItem;
use common\helpers\Token;
use yii\db\Expression;

/**
 * Default controller for the `mobile` module
 */
class CartController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionFindCartArray()
    {
        $cart = Order::findCartArray();

        print_r(Json::encode($cart));
    }

    public function actionAddToCart()
    {
        //Receive GET Parameter
        //$_GET["id"] = ProductId
        //$_GET["productSuppId"] = Product Supplier Id
        //$_GET["quantity"] = quantity to want add to cart
        //$_GET["fastId"] = No Date to send order
        //$_GET["supplierId"] = supplier Id
        //Return JSON Array of cart
        $_GET["id"] = 1;
        $_GET["productSuppId"] = 169;
        $_GET["quantity"] = 1;
        $_GET["fastId"] = 1;
        $_GET["supplierId"] = 1;
        $res = [];
        $order = Order::getOrder();
        if (!isset($order)) {
            $order = new Order();
            $order->token = Token::getToken();
            $order->status = Order::ORDER_STATUS_DRAFT;
            $order->createDateTime = new Expression("NOW()");
            if (!$order->save(FALSE)) {
                throw new \yii\base\Exception("Can't Save Order");
            }
        }
        //throw new \yii\base\Exception('fastId=' . $id);
        $orderItem = OrderItem::find()->where("orderId = " . $order->orderId . " AND productSuppId =" . $_GET['productSuppId'] . " and sendDate=" . $_GET['fastId'])->one();
        if (!isset($orderItem)) {
            $orderItem = new OrderItem();
            $orderItem->quantity = $_GET["quantity"];
        } else {
            $orderItem->quantity = $orderItem->quantity + $_GET["quantity"];
        }
        $product = new Product();
        $orderItem->sendDate = $_GET["fastId"];
        $orderItem->firstTimeSendDate = $_GET["fastId"];
        $orderItem->supplierId = $_GET['supplierId'];
        $orderItem->orderId = $order->orderId;
        $orderItem->productId = $_GET["id"];
        $orderItem->productSuppId = $_GET['productSuppId'];
        $productPrice = $product->calProductPrice($orderItem->productSuppId, $orderItem->quantity, 1, $_GET['fastId'], NULL);
        $orderItem->priceOnePiece = $orderItem->product->calProductPrice($orderItem->productSuppId, 1, 0, NULL, NULL);
        //$orderItem->priceOnePiece = $orderItem->product->calProductPrice($id, 1, 0, NULL, 'add');
        //$orderItem->priceOnePiece = $orderItem->product->calProductPrice($id, 1);
        $orderItem->price = $productPrice["price"];
        //throw new \yii\base\Exception($orderItem->priceOnePiece);
        $orderItem->subTotal = $orderItem->quantity * $orderItem->price;
        $orderItem->discountValue = isset($productPrice["discountValue"]) ? $productPrice["discountValue"] : 0;
        if (isset($productPrice["shippingDiscountValue"])) {
            $orderItem->shippingDiscountValue = $productPrice["shippingDiscountValue"];
            $orderItem->total = ($orderItem->quantity * $orderItem->price) - $orderItem->discountValue - $productPrice["shippingDiscountValue"];
        } else {
            $orderItem->total = ($orderItem->quantity * $orderItem->price) - $orderItem->discountValue;
        }

        $orderItem->createDateTime = new Expression("NOW()");
        if ($orderItem->save()) {
            if (Yii::$app->db->lastInsertID > 0) {
                $orderItemId = Yii::$app->db->lastInsertID;
            } else {
                $orderItemId = $orderItem->orderItemId;
            }
            $order->save();
            $res["shoppingCart"] = $this->createShoppingCart($order->orderId);
            $res["orderItemId"] = $orderItemId;
            $cartArray = Order::findCartArray();
            $res["cart"] = $cartArray;
            $pQuan = 0;
            foreach ($cartArray["items"] as $item) {
                if ($item["productSuppId"] == $_GET["id"]) {
                    $pQuan += $item["qty"];
                }
            }
            $product = new Product();
            $maxQuantity = $product->findMaxQuantity($_GET['productSuppId']);
            if ($pQuan >= $maxQuantity) {
                $res["isMaxQuantity"] = TRUE;
            } else {
                $res["isMaxQuantity"] = FALSE;
            }
        } else {
//            throw new \yii\base\Exception(print_r($orderItem->errors, true));
            $res["error"] = "ไม่สามารถเพิ่มสินค้าลงตระกร้าได้";
        }
        print_r(Json::encode($res));
    }

    public function actionRemoveFromCart($id)
    {
        //Receive Get Parameter
        //$_GET[id] = Order Item Id
        //Return Array of error
        $res = [];
        $orderItem = OrderItem::find()->where("orderItemId = " . $id)->one();
        $qnty = intval($orderItem->quantity);
        //throw new \yii\base\Exception($qnty);
        $orderId = $orderItem->orderId;
        if (OrderItem::deleteAll("orderItemId = $id") > 0) {
            $res["error"] = NULL;
            $order = Order::find()->where("orderId=" . $orderId)->one();
            $order->save(); // Save For Cal new total
            $cartArray = Order::findCartArray();
            $res["cart"] = $cartArray;
            $res["productSuppId"] = $orderItem->productSuppId;
            $res["deleteQnty"] = $qnty;
        } else {
            $res["error"] = "ไม่สามารถลบสินค้าออกจากตระกร้าได้";
        }

        print_r(Json::encode($res));
    }

    public function createShoppingCart($orderId)
    {
        $text = "";
        $showOrder = OrderItem::find()->where("orderId=" . $orderId)->all();
        if (isset($showOrder) && !empty($showOrder)) {
            $header = "<table id='cartTable' style='margin-top: -10px; font-size: 14px;'><tr><th>Items</th><th>Quantity</th><th>Price</th></tr>";
            $footer = "</table>";
            foreach ($showOrder as $item):
                $productSupp = ProductSuppliers::productSupplierName($item->productSuppId);
                $text = $text . '<tr class="item" id="item' . $item->orderItemId . '">'
                . '<td><div class="delete"><input type="hidden" id="orderItemId" value="' . $item->orderItemId . '"></div><a href="' . Yii::$app->homeUrl . 'products/' . \common\models\ModelMaster::encodeParams(["productId" => $item->productId, "productSupplierId" => $item->productSuppId]) . '">' . $productSupp->title . '</a></td>'
                . '<td class="qty"><input type="text" id="qty" value="' . $item->quantity . '" readonly="true"></td>'
                . '<td class="price">' . number_format(ProductSuppliers::productPriceSupplier($item->productSuppId), 2) . '</td><input type="hidden" id="productSuppId" value="' . $item->productSuppId . '"></tr>';
            endforeach;
            $text = $header . $text . $footer;
        }
        return $text;
    }
}
