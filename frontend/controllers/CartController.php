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
use common\models\costfit\Wishlist;
use common\models\costfit\ProductShelf;
use common\models\costfit\OrderItem;
use common\models\costfit\Order;

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
        // \frontend\assets\CartAsset::register($this);
        /* if (Yii::$app->user->isGuest) {
          return $this->redirect(Yii::$app->homeUrl . 'site/login');
          } */
        $this->title = 'Cozxy.com | cart';
        $this->subTitle = 'Shopping Cart';
        $fc = 0;
        if (isset($_GET['fc'])) {
            $fc = $_GET['fc'];
        }
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
        //$orderId = $this->params['cart']['orderId'];
        return $this->render('index', ['fc' => $fc]);
    }

    public function actionAddToCart($id) {
        $productId = $_GET['id'];

        $res = [];
        $order = Order::getOrder();
        if (!isset($order)) {
            $order = new Order();
            $order->token = \common\helpers\Token::getToken();
            $order->status = Order::ORDER_STATUS_DRAFT;
            $order->createDateTime = new \yii\db\Expression("NOW()");
            $order->paymentType = \common\models\costfit\PaymentMethod::TYPE_CREDIT_CARD;
            if (!$order->save(FALSE)) {
                throw new \yii\base\Exception("Can't Save Order");
            }
        }
        //throw new \yii\base\Exception('orderId=' . $order->orderId);
        $fastid = '';
        if ($fastid == '') {
            $orderItem = OrderItem::find()->where("orderId = " . $order->orderId . " AND productSuppId =" . $_POST['productSuppId'] . "")->one();
        } else {
            $orderItem = OrderItem::find()->where("orderId = " . $order->orderId . " AND productSuppId =" . $_POST['productSuppId'] . "" . " and sendDate=" . $fastid)->one();
        }
        //echo '<pre>';
        //print_r('fastid :' . $orderItem);
        //exit();
        if (!isset($orderItem)) {
            //echo 'test 1';
            $orderItem = new OrderItem();
            $orderItem->quantity = $_POST["quantity"];
        } else {
            //echo 'test 1';
            $orderItem->quantity = $orderItem->quantity + $_POST["quantity"];
        }

        /*
          ตรวจสอบจำนวนสินค้าคงเหลือ
         */
        if (isset($productId)) {
            $Qty = \common\models\costfit\ProductSuppliers::find()->where('productId=' . $productId . ' and productSuppId=' . $_POST['productSuppId'])->one();
            $quantityMain = $Qty->result;
            //if ((int) $orderItem->quantity > (int) $quantityMain) {
            if ((int) $orderItem->quantity > (int) $quantityMain) {
                //echo $quantityMain . '<br>::';
                //echo $orderItem->quantity;
                // exit();
                $res["isMaxQuantitys"] = 'NO';
                $res["status"] = FALSE;
                return \yii\helpers\Json::encode($res);
                die();
            } else {
                $res["status"] = TRUE;
                $res["isMaxQuantitys"] = 'YES';
            }
        }

        $product = new \common\models\costfit\Product();
        $orderItem->sendDate = $fastid;
        $orderItem->firstTimeSendDate = $fastid;
        $orderItem->supplierId = $_POST['supplierId'];
        $orderItem->orderId = $order->orderId;
        $orderItem->productId = $id;
        $orderItem->productSuppId = $_POST['productSuppId'];
        $orderItem->receiveType = $_POST['receiveType'];
        $productPrice = $product->calProductPrice($orderItem->productSuppId, $orderItem->quantity, 1, $fastid, NULL);
        $orderItem->priceOnePiece = $orderItem->product->calProductPrice($orderItem->productSuppId, 1, 0, NULL, NULL);
        $orderItem->price = $productPrice["price"];
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
            //echo '<pre>';
            //print_r($order->attributes);
            $order->save();


            $res["status"] = TRUE;
            $res["shoppingCart"] = $this->createShoppingCart($order->orderId);
            $res["orderItemId"] = $orderItemId;
            $cartArray = Order::findCartArray();
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

    public function actionDeleteCartItem() {
        if (Yii::$app->user->isGuest) {
            //return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $id = $_POST["id"];
        $res = [];
        $orderItem = OrderItem::find()->where("orderItemId = " . $id)->one();
        $qnty = intval($orderItem->quantity);
        //throw new \yii\base\Exception($qnty);
        $orderId = $orderItem->orderId;

        if (OrderItem::deleteAll("orderItemId = $id") > 0) {
            $res["status"] = TRUE;
            $order = Order::find()->where("orderId=" . $orderId)->one();
            $order->save(); // Save For Cal new total
            $cartArray = Order::findCartArray();
            $res["cart"] = $cartArray;
            $res["productSuppId"] = $orderItem->productSuppId;
            $res["deleteQnty"] = $qnty;
            $orderItems = OrderItem::find()->where("orderId = " . $orderId)->all();
            if (isset($orderItems) && count($orderItems) > 0) {
                $res["showCheckout"] = "yes";
            } else {
                $res["showCheckout"] = "no";
            }
        } else {
            $res["status"] = FALSE;
        }

        return \yii\helpers\Json::encode($res);
    }

    public function actionDeleteCoupon() {
        $res = [];
        $id = $_POST["id"];
        $order = Order::findOne($id);
        $order->couponId = NULL;
        $order->save();
        $cartArray = Order::findCartArray();
        $res["cart"] = $cartArray;
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
        $showOrder = OrderItem::find()->where("orderId=" . $orderId)->all();
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
        $order = Order::getOrder();
        $coupon = \common\models\costfit\Coupon::getCouponAvailable($_POST['couponCode']);
        if (isset($coupon)) {
            if (!$coupon->isExpired) {
                $order->couponId = $coupon->couponId;
                $order->save();
                $res["status"] = TRUE;
                $cartArray = Order::findCartArray();
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $res = [];
        $ws = Wishlist::find()->where("productId =" . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id . " and productShelfId=" . $_POST['shelfId'])->one();
        if (!isset($ws)) {
            $ws = new Wishlist();
            $ws->productShelfId = $_POST['shelfId'];
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
            $ws = Wishlist::find()->where("productId =" . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id . " and productShelfId=" . $_POST['shelfId'])->one();
            if (isset($ws)) {
                $ws->delete();
            }
            $ch = Wishlist::find()->where("productId =" . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id)->one();
            if (isset($ch)) {
                $res['heart'] = 1;
            } else {
                $res['heart'] = 0;
            }
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionAddDefaultWishlist() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $res = [];
        $defaultWishlist = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and type=1")->one();
        if (!isset($defaultWishlist)) {
            $default = new ProductShelf();
            $default->userId = Yii::$app->user->id;
            $default->title = 'Default Wishlist';
            $default->type = 1;
            $default->status = 1;
            $default->createDateTime = new \yii\db\Expression('NOW()');
            $default->updateDateTime = new \yii\db\Expression('NOW()');
            $default->save();
        }
        $defaultWishlist = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and type=1")->one();
        $defaultWishlistId = $defaultWishlist->productShelfId;
        $ws = Wishlist::find()->where("productId =" . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id . " and productShelfId=" . $defaultWishlistId)->one();
        $productSupp = \common\models\costfit\ProductSuppliers::find()->where("productSuppId=" . $_POST['productId'])->one();
        if (!isset($ws)) {
            $ws = new Wishlist();
            $ws->productShelfId = $defaultWishlistId;
            $ws->productId = $_POST['productId'];
            $ws->userId = \Yii::$app->user->id;
            $ws->createDateTime = new \yii\db\Expression("NOW()");
            if ($ws->save()) {
                $res["status"] = TRUE;
                // $res['title'] = \common\models\costfit\ProductSuppliers::productSupplierName($_POST['productId'])->title;
            } else {
                $res["status"] = FALSE;
                $res['errorCode'] = 2;
                $res["message"] = "Can't save Wishlist";
            }
        } else {
            $res["status"] = FALSE;
            $res['errorCode'] = 1;
            $res["message"] = "This item is already in your Wishlist";
            /* $ws = Wishlist::find()->where("productId =" . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id . " and productShelfId=" . $defaultWishlistId)->one();
              if (isset($ws)) {
              $ws->delete();
              } */
            $ch = Wishlist::find()->where("productId =" . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id)->one();
            if (isset($ch)) {
                $res['heart'] = 1;
            } else {
                $res['heart'] = 0;
            }
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionDeleteWishlist() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $res = [];
        $ws = Wishlist::find()->where("wishlistId = " . $_POST['wishlistId'] . " AND userId = " . \Yii::$app->user->id)->one();
        if (isset($ws)) {
            Wishlist::deleteAll("wishlistId = " . $_POST['wishlistId'] . " AND userId = " . \Yii::$app->user->id);
            $length = count(Wishlist::find()->where("userId = " . \Yii::$app->user->id)->all());
            $itemInWishlist = count(Wishlist::find()->where("userId=" . Yii::$app->user->id . " and productShelfId=" . $_POST['shelfId'])->all());    //sak
            if ($itemInWishlist == 0) {
                $res["text"] = "<h4>No story in fav item <span style='margin-left:20px;font-size:12pt;'><a href='' data-toggle='modal' data-target='#FavoriteModal'><u>Whats this? </u></a></span></h4>";
                $res["total"] = TRUE;
            } else {
                $res["total"] = FALSE;
            }
            $res["status"] = TRUE;
            $res["length"] = $length;
        } else {
            $res["status"] = FALSE;
            $res['errorCode'] = 1;
            $res["message"] = "Exits product in Wishlist";
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionDeleteWishlistShelf() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $res = [];
        $ws = Wishlist::find()->where("productId =" . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id . " and productShelfId=" . $_POST['shelfId'])->one();
        if (isset($ws)) {
            $ws->delete();
            $res["status"] = TRUE;
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

        $sendDate = $_POST["sendDate"];


        $price = $product->calProductPrice($_POST["productSuppId"], $_POST["quantity"], 1, $_POST["sendDate"], NULL);
        // throw new \yii\base\Exception(print_r($_POST["sendDate"], true));
        $maxQuantity = $product->findMaxQuantitySupplier($_POST["productSuppId"], 0);
//        throw new \yii\base\Exception("max quantity = " . $maxQuantity);
        if ($_POST["quantity"] <= $maxQuantity) {
            if (isset($price)) {
                $cart = Order::findCartArray();
                if ($sendDate != '') {
                    $oi = OrderItem::find()->where("productSuppId = " . $_POST["productSuppId"] . " AND orderId = " . $cart["orderId"] . " AND sendDate = " . $_POST["sendDate"])->one();
                } else {
                    $oi = OrderItem::find()->where("productSuppId = " . $_POST["productSuppId"] . " AND orderId = " . $cart["orderId"])->one();
                }
                //$oi = orderItem::find()->where("productSuppId = " . $_POST["productSuppId"] . " AND orderId = " . $cart["orderId"] . " AND sendDate = " . $_POST["sendDate"])->one();
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
                $cart = Order::findCartArray();
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
            $order = Order::find()->where("orderId = " . $_POST['orderId'])->one();
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
        if (isset($products) && count($products) > 0) {
            $i = 0;
            foreach ($products as $product):
                $productSuppliers = \common\models\costfit\ProductSuppliers::find()->where("productId = " . $product->productId . " and approve = 'approve'")->all();
                if (isset($productSuppliers) && count($productSuppliers) > 0) {
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
            if (isset($productSuppId) && count($productSuppId) > 0) {
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
        $itemsLockers = OrderItem::find()->where('orderId=' . $orderId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_HOT)->all(); // status : 2
        $itemsLockersCool = OrderItem::find()->where('orderId=' . $orderId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_COOL)->all(); // status : 1
        $itemsBooth = OrderItem::find()->where('orderId=' . $orderId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_BOOTH)->all(); // status : 3
        return $this->render('cart_list_product_all', compact('products', 'GetOrderMasters', 'itemsLockers', 'itemsBooth', 'itemsLockersCool'));
    }

    public function actionGetProductQuantity() {

        $order = Order::getOrder();
        if (isset($order->attributes['orderId'])) {
            $orderId = $order->attributes['orderId'];

            //$Product = Order::find()->where('userId =' . \Yii::$app->user->id . ' and status=0')->one();
            $Product = Order::find()->where('orderId=' . $orderId . ' and status=0')->one();
            if (count($Product) > 0) {
                $orderItem = OrderItem::find()->where('orderId=' . $Product['orderId'])->sum('quantity');
                if (isset($orderItem)) {
                    echo (int) $orderItem;
                } else {
                    echo '';
                }
            } else {
                echo '';
            }
        } else {
            echo '';
        }
    }

}
