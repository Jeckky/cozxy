<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\helpers\PickingPoint;

class CartController extends MasterController {

    public function beforeAction($action) {
        if ($action->id == 'add-coupon' || $action->id == 'change-quantity-item-and-save' || $action->id == 'add-to-cart') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        $this->title = 'Cozxy.com | cart';
        $this->subTitle = 'Shopping Cart';
        /* $allProducts = $this->allProduct();
          $id = '';
          if (isset($allProducts) && !empty($allProducts) && ($allProducts != '')) {
          foreach ($allProducts as $item):
          $id = $id . $item . ",";
          endforeach;
          $id = substr($id, 0, -1);
          $products = \common\models\costfit\ProductSuppliers::find()
          ->where("productSuppId in ($id) and approve='approve'")
          ->orderBy(new \yii\db\Expression('rand()'))
          ->limit(4)
          ->all();
          } else {
          $products = \common\models\costfit\ProductSuppliers::find()->where("approve='approve'")
          ->orderBy(new \yii\db\Expression('rand()'))
          ->limit(4)
          ->all();
          }
          //$product = \common\models\costfit\search\Product::find()->where("categoryId='3'")->all();
          $this->subSubTitle = ''; */
        //return $this->render('cart');
        return $this->render('index');
    }

    public function actionAddToCart($id) {
        $res = [];
        $order = \common\models\costfit\Order::getOrder();
        if (!isset($order)) {
            $order = new \common\models\costfit\Order();
            $order->token = \common\helpers\Token::getToken();
            $order->status = \common\models\costfit\Order::ORDER_STATUS_DRAFT;
            $order->createDateTime = new \yii\db\Expression("NOW()");
            $order->paymentType = \common\models\costfit\PaymentMethod::TYPE_CREDIT_CARD;
            if (!$order->save(FALSE)) {
                throw new \yii\base\Exception("Can't Save Order");
            }
        }
        //throw new \yii\base\Exception('fastId=' . $id);
        $fastid = $_POST['fastId'];
        if ($fastid == '') {
            $fastid = 1;
            $orderItem = \common\models\costfit\OrderItem::find()->where("orderId = " . $order->orderId . " AND productSuppId =" . $_POST['productSuppId'] . ""
            . " and sendDate=" . $fastid)->one();
        } else {
            $orderItem = \common\models\costfit\OrderItem::find()->where("orderId = " . $order->orderId . " AND productSuppId =" . $_POST['productSuppId'] . ""
            . " and sendDate=" . $fastid)->one();
        }

        if (!isset($orderItem)) {
            $orderItem = new \common\models\costfit\OrderItem();
            $orderItem->quantity = $_POST["quantity"];
        } else {
            $orderItem->quantity = $orderItem->quantity + $_POST["quantity"];
        }
        $product = new \common\models\costfit\Product();
        $orderItem->sendDate = $_POST["fastId"];
        $orderItem->firstTimeSendDate = $_POST["fastId"];
        $orderItem->supplierId = $_POST['supplierId'];
        $orderItem->orderId = $order->orderId;
        $orderItem->productId = $id;
        $orderItem->productSuppId = $_POST['productSuppId'];
        $orderItem->receiveType = $_POST['receiveType'];
        $productPrice = $product->calProductPrice($orderItem->productSuppId, $orderItem->quantity, 1, $fastid, NULL);
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
            $res["status"] = TRUE;
            $res["shoppingCart"] = $this->createShoppingCart($order->orderId);
            $res["orderItemId"] = $orderItemId;
            $cartArray = \common\models\costfit\Order::findCartArray();
            $res["cart"] = $cartArray;
            $pQuan = 0;
            foreach ($cartArray["items"] as $item) {
                if ($item["productSuppId"] == $id) {
                    $pQuan += $item["qty"];
                }
            }
            $product = new \common\models\costfit\Product();
            $maxQuantity = $product->findMaxQuantity($_POST['productSuppId']);
            if ($pQuan >= $maxQuantity) {
                $res["isMaxQuantity"] = TRUE;
            } else {
                $res["isMaxQuantity"] = FALSE;
            }
        } else {
//            throw new \yii\base\Exception(print_r($orderItem->errors, true));
            $res["status"] = FALSE;
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionDeleteCartItem($id) {
        $res = [];
        $orderItem = \common\models\costfit\OrderItem::find()->where("orderItemId = " . $id)->one();
        $qnty = intval($orderItem->quantity);
        //throw new \yii\base\Exception($qnty);
        $orderId = $orderItem->orderId;
        if (\common\models\costfit\OrderItem::deleteAll("orderItemId = $id") > 0) {
            $res["status"] = TRUE;
            $order = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->one();
            $order->save(); // Save For Cal new total
            $cartArray = \common\models\costfit\Order::findCartArray();
            $res["cart"] = $cartArray;
            $res["productSuppId"] = $orderItem->productSuppId;
            $res["deleteQnty"] = $qnty;
        } else {
            $res["status"] = FALSE;
        }

        return \yii\helpers\Json::encode($res);
    }

    public function actionChangeQuantityItem() {

        $res = [];
        $product = new \common\models\costfit\Product();
        //$price = $product->calProductPrice($_POST["productId"], $_POST["quantity"], 1, NULL, 'add');
        $price = $product->calProductPrice($_POST["productSuppId"], $_POST["quantity"], 1, NULL, NULL);
        $maxQuantity = $product->findMaxQuantity($_POST["productSuppId"]);
        if ($_POST["quantity"] <= $maxQuantity) {
            if (isset($price)) {
                $res["status"] = TRUE;
                $res["price"] = $price["price"];
                $res["priceText"] = $price["priceText"];
                $res["discountType"] = $price["discountType"];
                $res["discountValue"] = $price["discountValue"];
            } else {
                $res["status"] = FALSE;
                $res['errorCode'] = 2;
            }
        } else {
            $res["status"] = FALSE;
            $res['errorCode'] = 1;
        }

        return \yii\helpers\Json::encode($res);
    }

    public function createShoppingCart($orderId) {
        $text = "";
        $showOrder = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->all();
        if (isset($showOrder) && !empty($showOrder)) {
            $header = "<table id='cartTable' style='margin-top: -10px;
        font-size: 14px;
        '><tr><th>Items</th><th>Quantity</th><th>Price</th></tr>";
            $footer = "</table>";
            foreach ($showOrder as $item):
                $productSupp = \common\models\costfit\ProductSuppliers::productSupplierName($item->productSuppId);
                $text = $text . '<tr class = "item" id = "item' . $item->orderItemId . '">'
                . '<td><div class = "delete"><input type = "hidden" id = "orderItemId" value = "' . $item->orderItemId . '"></div><a href = "' . Yii::$app->homeUrl . 'products/' . \common\models\ModelMaster::encodeParams(["productId" => $item->productId, "productSupplierId" => $item->productSuppId]) . '">' . $productSupp->title . '</a></td>'
                . '<td class = "qty"><input type = "text" id = "qty" value = "' . $item->quantity . '" readonly = "true"></td>'
                . '<td class = "price">' . number_format(\common\models\costfit\ProductSuppliers::productPriceSupplier($item->productSuppId), 2) . '</td><input type = "hidden" id = "productSuppId" value = "' . $item->productSuppId . '"></tr>';
            endforeach;
            $text = $header . $text . $footer;
        }
        /* $text = $text . '<tr class = "item">'
          . '<td><div class = "delete"><input type = "hidden" id = "orderItemId" value = "' . $item->orderItemId . '"></div><a href = "#">' . $productSupp->title . ''
          . '<td class = "qty"><input type = "text" id = "qty" value = "' . $item->quantity . '" readonly = "true"></td>'
          . '<td class = "price">' . number_format(\common\models\costfit\ProductSuppliers::productPriceSupplier($item->productSuppId), 2) . '</td></tr>';
         */
        return $text;
    }

    public function actionAddCoupon() {
        $res = [];
        $order = \common\models\costfit\Order::getOrder();
        $coupon = \common\models\costfit\Coupon::getCouponAvailable($_POST['couponCode']);
        if (isset($coupon)) {
            if (!$coupon->isExpired) {
                $order->couponId = $coupon->couponId;
                $order->save();
                $res["status"] = TRUE;
                $cartArray = \common\models\costfit\Order::findCartArray();
                $res["cart"] = $cartArray;
            } else {
                $res["status"] = FALSE;
                $res["message"] = "This Coupon Expired.";
            }
        } else {
            $res["status"] = FALSE;
            $res["message"] = "No Found this Coupon Code.";
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionAddWishlist() {
        $res = [];
        $ws = \common\models\costfit\Wishlist::find()->where("productId =" . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id)->one();
        if (!isset($ws)) {
            $ws = new \common\models\costfit\Wishlist();
            $ws->productId = $_POST['productId'];
            $ws->userId = \Yii::$app->user->id;
            $ws->createDateTime = new \yii\db\Expression("NOW()");
            if ($ws->save()) {
                $res["status"] = TRUE;
            } else {
                $res["status"] = FALSE;
                $res['errorCode'] = 2;
                $res["message"] = "Can't save Wishlist";
            }
        } else {
            $res["status"] = FALSE;
            $res['errorCode'] = 1;
            $res["message"] = "This item is already in your Wishlist";
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionDeleteWishlist() {
        $res = [];
        $ws = \common\models\costfit\Wishlist::find()->where("productId = " . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id)->one();
        if (isset($ws)) {
            \common\models\costfit\Wishlist::deleteAll("productId = " . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id);
            $length = count(\common\models\costfit\Wishlist::find()->where("userId = " . \Yii::$app->user->id)->all());
            $res["status"] = TRUE;
            $res["length"] = $length;
        } else {
            $res["status"] = FALSE;
            $res['errorCode'] = 1;
            $res["message"] = "Exits product in Wishlist";
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionGenerateNewToken() {
        $res = [];
        \common\helpers\Token::generateNewToken();
        $res["status"] = TRUE;
        return \yii\helpers\Json::encode($res);
    }

    public function actionChangeQuantityItemAndSave() {

        $res = [];
        $product = new \common\models\costfit\Product();
        $price = $product->calProductPrice($_POST["productSuppId"], $_POST["quantity"], 1, $_POST["sendDate"], NULL);
//        throw new \yii\base\Exception(print_r($price, true));
        $maxQuantity = $product->findMaxQuantitySupplier($_POST["productSuppId"], 0);
//        throw new \yii\base\Exception("max quantity = " . $maxQuantity);
        if ($_POST["quantity"] <= $maxQuantity) {
            if (isset($price)) {
                $cart = \common\models\costfit\Order::findCartArray();
                $oi = \common\models\costfit\OrderItem::find()->where("productSuppId = " . $_POST["productSuppId"] . " AND orderId = " . $cart["orderId"] . " AND sendDate = " . $_POST["sendDate"])->one();
                $oi->price = $price["price"];
                $oi->quantity = $_POST["quantity"];
                $oi->priceOnePiece = $oi->product->calProductPrice($_POST["productSuppId"], 1, 0, NULL, NULL);
                $oi->subTotal = $oi->price * $_POST["quantity"];
                $oi->discountValue = $price["discountValue"];
                if (isset($price["shippingDiscountValue"])) {
                    $oi->shippingDiscountValue = $price["shippingDiscountValue"];
                    $oi->total = ($oi->quantity * $oi->price) - $oi->discountValue - $price["shippingDiscountValue"];
                } else {
                    $oi->total = ($oi->quantity * $oi->price) - $oi->discountValue;
                }
//                $oi->total = ($oi->price * $_POST["quantity"]) - $price["discountValue"];
                $oi->save();
                $cart = \common\models\costfit\Order::findCartArray();
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

        return \yii\helpers\Json::encode($res);
    }

    public function actionSaveSlowest() {
        if (isset($_POST['orderId'])) {
            $order = \common\models\costfit\Order::find()->where("orderId = " . $_POST['orderId'])->one();
            if (isset($order)) {
                if ($_POST['type'] == 1) {
                    $order->isSlowest = 1;
                } else {
                    $order->isSlowest = 0;
                }
                $order->save(false); // For save Is Slowest before update order item price
                foreach ($order->orderItems as $oi) {
                    $product = new \common\models\costfit\Product();
                    if ($_POST['type'] == 2) {
                        $oi->sendDate = $oi->firstTimeSendDate;
                    }
                    $price = $product->calProductPrice($oi->productId, $oi->quantity, 1, NULL, $oi->orderItemId);
                    $oi->price = $price["price"];
                    $oi->priceOnePiece = $oi->product->calProductPrice($oi->productId, 1, 1, NULL, 'add');
                    $oi->subTotal = $oi->price * $oi->quantity;
                    $oi->discountValue = $price["discountValue"];
                    if (isset($price["shippingDiscountValue"])) {
                        $oi->shippingDiscountValue = $price["shippingDiscountValue"];
                        $oi->total = ($oi->quantity * $oi->price) - $oi->discountValue - $price["shippingDiscountValue"];
                    } else {
                        $oi->total = ($oi->quantity * $oi->price) - $oi->discountValue;
                    }
                    $oi->save();
                }
                $order->save(false); // For update total discount and summary
            }
        }
        echo $_POST['orderId'];
    }

    public function allProduct() {
        $products = \common\models\costfit\Product::find()->where("approve = 'approve'")->all();
        $productSuppId = [];
        if (isset($products) && !empty($products)) {
            $i = 0;
            foreach ($products as $product):
                $productSuppliers = \common\models\costfit\ProductSuppliers::find()->where("productId = " . $product->productId . " and approve = 'approve'")->all();
                if (isset($productSuppliers) && !empty($productSuppliers)) {
                    $id = '';
                    foreach ($productSuppliers as $productSupplier):
                        $id = $id . $productSupplier->productSuppId . ",";
                    endforeach;
                    $id = substr($id, 0, -1);
                    if ($id != '') {
                        $price = \common\models\costfit\ProductPriceSuppliers::find()->where("productSuppId in ($id)")->orderBy("price ASC")->one();
                        $productSuppId[$i] = $price->productSuppId;
                        $i++;
                    }
                }
            endforeach;
            if (isset($productSuppId) && !empty($productSuppId)) {
                return $productSuppId;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public function actionListProductAll() {
        $this->layout = "/content_right";
        $this->title = 'Cozxy.com | cart';
        $this->subTitle = 'Checkout Cart';
        $allProducts = $this->allProduct();
        $id = '';
        if (isset($allProducts) && !empty($allProducts) && ($allProducts != '')) {
            foreach ($allProducts as $item):
                $id = $id . $item . ",";
            endforeach;
            $id = substr($id, 0, -1);
            $products = \common\models\costfit\ProductSuppliers::find()
            ->where("productSuppId in ($id) and approve = 'approve'")
            ->orderBy(new \yii\db\Expression('rand()'))
            ->limit(4)
            ->all();
        } else {
            $products = \common\models\costfit\ProductSuppliers::find()->where("approve = 'approve'")
            ->orderBy(new \yii\db\Expression('rand()'))
            ->limit(4)
            ->all();
        }
        $this->subSubTitle = '';
        //echo '<pre>';
        //print_r($this->view->params['cart']);
        // echo $this->view->params['cart']['orderId'];
        //exit();
        $orderId = $this->view->params['cart']['orderId'];
        $GetOrderMasters = PickingPoint::GetOrderItemrGroupMaster($orderId);
        $itemsLockers = \common\models\costfit\OrderItem::find()->where('orderId=' . $orderId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_HOT)->all(); // status : 2
        $itemsLockersCool = \common\models\costfit\OrderItem::find()->where('orderId=' . $orderId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_COOL)->all(); // status : 1
        $itemsBooth = \common\models\costfit\OrderItem::find()->where('orderId=' . $orderId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_BOOTH)->all(); // status : 3
        return $this->render
        ('cart_list_product_all', compact('products', 'GetOrderMasters', 'itemsLockers', 'itemsBooth', 'itemsLockersCool'));
    }

}
