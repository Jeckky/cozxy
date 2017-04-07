<?php

namespace frontend\modules\mobile\controllers;

use Yii;
use yii\web\Controller;
use \yii\helpers\Json;
use frontend\controllers\MasterController;

/**
 * Default controller for the `mobile` module
 */
class OrderController extends MasterController
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $cartArray = \common\models\costfit\Order::findCartArrayForMobile();
        print_r(\yii\helpers\Json::encode($cartArray));
    }

    public function actionFindCartArray()
    {
        $cart = \common\models\costfit\Order::findCartArrayForMobile();

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
//        $_GET["id"] = 1;
//        $_GET["productSuppId"] = 169;
//        $_GET["quantity"] = 1;
//        $_GET["fastId"] = 1;
//        $_GET["supplierId"] = 1;
        $res = [];
        $order = \common\models\costfit\Order::getOrder();
        if (!isset($order)) {
            $order = new \common\models\costfit\Order();
            $order->token = $this->getToken();
            $order->status = \common\models\costfit\Order::ORDER_STATUS_DRAFT;
            $order->createDateTime = new \yii\db\Expression("NOW()");
            if (!$order->save(FALSE)) {
                throw new \yii\base\Exception("Can't Save Order");
            }
        }


        $res['token'] = $order->token;

        //throw new \yii\base\Exception('fastId=' . $id);
        $orderItem = \common\models\costfit\OrderItem::find()->where("orderId = " . $order->orderId . " AND productSuppId =" . $_GET['productSuppId'] . " and sendDate=" . $_GET['fastId'])->one();
        if (!isset($orderItem)) {
            $orderItem = new \common\models\costfit\OrderItem();
            $orderItem->quantity = $_GET["quantity"];
        } else {
            $orderItem->quantity = $orderItem->quantity + $_GET["quantity"];
        }
        $product = new \common\models\costfit\Product();
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

        $orderItem->createDateTime = new \yii\db\Expression("NOW()");
        if ($orderItem->save()) {
            if (Yii::$app->db->lastInsertID > 0) {
                $orderItemId = Yii::$app->db->lastInsertID;
            } else {
                $orderItemId = $orderItem->orderItemId;
            }
            $order->save();
            $res["shoppingCart"] = $this->createShoppingCart($order->orderId);
            $res["orderItemId"] = $orderItemId;
            $cartArray = \common\models\costfit\Order::findCartArrayForMobile();
            $res["cart"] = $cartArray;
            $pQuan = 0;
            foreach ($cartArray["items"] as $item) {
                if ($item["productSuppId"] == $_GET["id"]) {
                    $pQuan += $item["qty"];
                }
            }
            $product = new \common\models\costfit\Product();
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

        print_r(\yii\helpers\Json::encode($res));
    }

    public function actionDeleteCartItem($id)
    {
        //Receive Get Parameter
        //$_GET[id] = Order Item Id
        //Return Array of error
        $res = [];
        $orderItem = \common\models\costfit\OrderItem::find()->where("orderItemId = " . $id)->one();
        $qnty = intval($orderItem->quantity);
        //throw new \yii\base\Exception($qnty);
        $orderId = $orderItem->orderId;
        if (\common\models\costfit\OrderItem::deleteAll("orderItemId = $id") > 0) {
            $res["error"] = NULL;
            $order = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->one();
            $order->save(); // Save For Cal new total
            $cartArray = \common\models\costfit\Order::findCartArrayForMobile();
            $res["cart"] = $cartArray;
            $res["productSuppId"] = $orderItem->productSuppId;
            $res["deleteQnty"] = $qnty;
        } else {
            $res["error"] = "ไม่สามารถลบสินค้าออกจากตระกร้าได้";
        }


        print_r(\yii\helpers\Json::encode($res));
    }

    public function getToken()
    {
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has('orderToken')) {

            return $cookies->getValue('orderToken');
        } else {
            $this->generateNewToken();
            $cookies = Yii::$app->request->cookies;
//            echo print_r($cookies, true);
//            throw new \yii\base\Exception(111);
//            if (!isset($cookies['orderToken'])) {
//                $cookies = Yii::$app->request->cookies;
//        }
            return $cookies->getValue('orderToken');
        }
    }

    public function createShoppingCart($orderId)
    {
        $text = "";
        $showOrder = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->all();
        if (isset($showOrder) && !empty($showOrder)) {
            $header = "<table id='cartTable' style='margin-top: -10px; font-size: 14px;'><tr><th>Items</th><th>Quantity</th><th>Price</th></tr>";
            $footer = "</table>";
            foreach ($showOrder as $item):
                $productSupp = \common\models\costfit\ProductSuppliers::productSupplierName($item->productSuppId);
                $text = $text . '<tr class="item" id="item' . $item->orderItemId . '">'
                . '<td><div class="delete"><input type="hidden" id="orderItemId" value="' . $item->orderItemId . '"></div><a href="' . Yii::$app->homeUrl . 'products/' . \common\models\ModelMaster::encodeParams(["productId" => $item->productId, "productSupplierId" => $item->productSuppId]) . '">' . $productSupp->title . '</a></td>'
                . '<td class="qty"><input type="text" id="qty" value="' . $item->quantity . '" readonly="true"></td>'
                . '<td class="price">' . number_format(\common\models\costfit\ProductSuppliers::productPriceSupplier($item->productSuppId), 2) . '</td><input type="hidden" id="productSuppId" value="' . $item->productSuppId . '"></tr>';
            endforeach;
            $text = $header . $text . $footer;
        }
        /* $text = $text . '<tr class="item">'
          . '<td><div class="delete"><input type="hidden" id="orderItemId" value="' . $item->orderItemId . '"></div><a href="#">' . $productSupp->title . ''
          . '<td class="qty"><input type="text" id="qty" value="' . $item->quantity . '" readonly="true"></td>'
          . '<td class="price">' . number_format(\common\models\costfit\ProductSuppliers::productPriceSupplier($item->productSuppId), 2) . '</td></tr>';
         */
        return $text;
    }

    public function actionAddWishlist()
    {
        //Receive Get Parameter
        //$_GET[productId] = productId
        //Return Array of error
        $res = [];
        $ws = \common\models\costfit\Wishlist::find()->where("productId =" . $_GET['productId'] . " AND userId = " . \Yii::$app->user->id)->one();
        if (!isset($ws)) {
            $ws = new \common\models\costfit\Wishlist();
            $ws->productId = $_GET['productId'];
            $ws->userId = \Yii::$app->user->id;
            $ws->createDateTime = new \yii\db\Expression("NOW()");
            if ($ws->save()) {
                $res["error"] = NULL;
            } else {
                $res["error"] = $ws->errors;
            }
        } else {
            $res["error"] = "Exits product in Wishlist";
        }
        print_r(\yii\helpers\Json::encode($res));
    }

    public function actionDeleteWishlist()
    {
        //Receive Get Parameter
        //$_GET[productId] = productId
        //Return Array of error
        $res = [];
        $ws = \common\models\costfit\Wishlist::find()->where("productId =" . $_GET['productId'] . " AND userId = " . \Yii::$app->user->id)->one();
        if (isset($ws)) {
            \common\models\costfit\Wishlist::deleteAll("productId =" . $_GET['productId'] . " AND userId = " . \Yii::$app->user->id);
            $length = count(\common\models\costfit\Wishlist::find()->where("userId = " . \Yii::$app->user->id)->all());
            $res["error"] = NULL;
            $res["length"] = $length;
        } else {
            $res["error"] = "ไม่สามารถลบรายการได้";
        }
        print_r(\yii\helpers\Json::encode($res));
    }

    public function actionUpdateCartItem()
    {

        $res = [];
        $product = new \common\models\costfit\Product();
        $price = $product->calProductPrice($_GET["productSuppId"], $_GET["quantity"], 1, $_GET["sendDate"], NULL);
//        throw new \yii\base\Exception(print_r($price, true));
        $maxQuantity = $product->findMaxQuantitySupplier($_GET["productSuppId"], 0);
//        throw new \yii\base\Exception("max quantity=" . $maxQuantity);
        if ($_GET["quantity"] <= $maxQuantity) {
            if (isset($price)) {
                $cart = \common\models\costfit\Order::findCartArrayForMobile();
                $oi = \common\models\costfit\OrderItem::find()->where("productSuppId = " . $_GET["productSuppId"] . " AND orderId=" . $cart["orderId"] . " AND sendDate =" . $_GET["sendDate"])->one();
                $oi->price = $price["price"];
                $oi->quantity = $_GET["quantity"];
                $oi->priceOnePiece = $oi->product->calProductPrice($_GET["productSuppId"], 1, 0, NULL, NULL);
                $oi->subTotal = $oi->price * $_GET["quantity"];
                $oi->discountValue = $price["discountValue"];
                if (isset($price["shippingDiscountValue"])) {
                    $oi->shippingDiscountValue = $price["shippingDiscountValue"];
                    $oi->total = ($oi->quantity * $oi->price) - $oi->discountValue - $price["shippingDiscountValue"];
                } else {
                    $oi->total = ($oi->quantity * $oi->price) - $oi->discountValue;
                }
//                $oi->total = ($oi->price * $_POST["quantity"]) - $price["discountValue"];
                $oi->save();
                $cart = \common\models\costfit\Order::findCartArrayForMobile();
                $res["status"] = TRUE;
                $res["price"] = $price["price"];
                $res["priceText"] = $price["priceText"];
                $res["priceOnePiece"] = $oi->priceOnePiece;
                $res["priceOnePieceText"] = number_format($oi->priceOnePiece, 2);
                $res["saving"] = $price["discountValue"];
                $res["savingText"] = number_format($price["discountValue"], 2);
                $res["orderItemId"] = $oi->orderItemId;
                $res["cart"] = $cart;
                $res["discountType"] = $price["discountType"];
                $res["discountValue"] = $price["discountValue"];
                $res["shippingDiscountValue"] = isset($price["shippingDiscountValue"]) ? $price["shippingDiscountValue"] : 0;
                $res["shippingDiscountValueText"] = isset($price["shippingDiscountValue"]) ? number_format($price["shippingDiscountValue"], 2) : number_format(0, 2);
                $res["total"] = $oi->total;
                $res["totalText"] = number_format($oi->total, 2);
                $res["subTotal"] = $oi->subTotal;
                $res["subTotalText"] = number_format($oi->subTotal, 2);
            } else {
                $res["status"] = FALSE;
                $res['errorCode'] = 2;
            }
        } else {
            $res["status"] = FALSE;
            $res['errorCode'] = 1;
        }

        print_r(\yii\helpers\Json::encode($res));
    }

    public function actionPickingPointByReceiveType()
    {
        $res = [];

        $pickingPoints = \common\models\costfit\PickingPoint::find()->where("type =" . $_GET['receiveType'])->all();

        $i = 0;
        foreach ($pickingPoints as $pp) {
            foreach ($pp->attributes as $attr => $v) {
                $res[$i][$attr] = $v;
            }
            $i++;
        }

        print_r(\yii\helpers\Json::encode($res));
    }

}
