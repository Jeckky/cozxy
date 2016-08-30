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

/**
 * Cart controller
 */
class CartController extends MasterController {

    public function beforeAction($action) {
        if ($action->id == 'add-coupon' || $action->id == 'change-quantity-item-and-save') {
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
        $this->layout = "/content_right";
        $this->title = 'Cost.fit | cart';
        $this->subTitle = 'Shopping Cart';
        $this->subSubTitle = '';
        return $this->render('cart');
    }

    public function actionAddToCart($id) {
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
        $orderItem = \common\models\costfit\OrderItem::find()->where("orderId = " . $order->orderId . " AND productId =" . $id . " and sendDate=" . $_POST["fastId"])->one();
        if (!isset($orderItem)) {
            $orderItem = new \common\models\costfit\OrderItem();
            $orderItem->quantity = $_POST["quantity"];
        } else {
            $orderItem->quantity = $orderItem->quantity + $_POST["quantity"];
        }
        $orderItem->orderId = $order->orderId;
        $orderItem->productId = $id;
        $orderItem->sendDate = $_POST["fastId"];
        $orderItem->priceOnePiece = $orderItem->product->calProductPrice($id, 1);
        $orderItem->price = $orderItem->product->calProductPrice($id, $orderItem->quantity);
        $orderItem->total = $orderItem->quantity * $orderItem->price;
        $orderItem->createDateTime = new \yii\db\Expression("NOW()");
        if ($orderItem->save()) {
            if (Yii::$app->db->lastInsertID > 0) {
                $orderItemId = Yii::$app->db->lastInsertID;
            } else {
                $orderItemId = $orderItem->orderItemId;
            }
            $order->save();
            $res["status"] = TRUE;
            $res["orderItemId"] = $orderItemId;
            $cartArray = \common\models\costfit\Order::findCartArray();
            $res["cart"] = $cartArray;
            $pQuan = 0;
            foreach ($cartArray["items"] as $item) {
                if ($item["productId"] == $id) {
                    $pQuan+=$item["qty"];
                }
            }
            $product = new \common\models\costfit\Product();
            $maxQuantity = $product->findMaxQuantity($id);
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
        $orderId = $orderItem->orderId;
        if (\common\models\costfit\OrderItem::deleteAll("orderItemId = $id") > 0) {
            $res["status"] = TRUE;
            $order = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->one();
            $order->save(); // Save For Cal new total
            $cartArray = \common\models\costfit\Order::findCartArray();
            $res["cart"] = $cartArray;
        } else {
            $res["status"] = FALSE;
        }

        return \yii\helpers\Json::encode($res);
    }

    public function actionChangeQuantityItem() {

        $res = [];
        $product = new \common\models\costfit\Product();
        $price = $product->calProductPrice($_POST["productId"], $_POST["quantity"], 1);
        $maxQuantity = $product->findMaxQuantity($_POST["productId"]);
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
            $res["message"] = "Exits product in Wishlist";
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionDeleteWishlist() {
        $res = [];
        $ws = \common\models\costfit\Wishlist::find()->where("productId =" . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id)->one();
        if (isset($ws)) {
            \common\models\costfit\Wishlist::deleteAll("productId =" . $_POST['productId'] . " AND userId = " . \Yii::$app->user->id);
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
        $this->generateNewToken();
        $res["status"] = TRUE;
        return \yii\helpers\Json::encode($res);
    }

    public function actionChangeQuantityItemAndSave() {

        $res = [];
        $product = new \common\models\costfit\Product();
        $price = $product->calProductPrice($_POST["productId"], $_POST["quantity"], 1);

        $maxQuantity = $product->findMaxQuantity($_POST["productId"], 0);
//        throw new \yii\base\Exception("max quantity=" . $maxQuantity);
        if ($_POST["quantity"] <= $maxQuantity) {
            if (isset($price)) {
                $cart = \common\models\costfit\Order::findCartArray();
                $oi = \common\models\costfit\OrderItem::find()->where("productId = " . $_POST["productId"] . " AND orderId=" . $cart["orderId"])->one();
                $oi->price = $price["price"];
                $oi->quantity = $_POST["quantity"];
                $oi->priceOnePiece = $oi->product->calProductPrice($_POST["productId"], 1);
                $oi->total = $oi->price * $_POST["quantity"];
                $oi->save();
                $cart = \common\models\costfit\Order::findCartArray();
                $res["status"] = TRUE;
                $res["price"] = $price["price"];
                $res["priceText"] = $price["priceText"];
                $res["priceOnePiece"] = $oi->priceOnePiece;
                $res["priceOnePieceText"] = number_format($oi->priceOnePiece, 2);
                $res["saving"] = $oi->priceOnePiece - $price["price"];
                $res["orderItemId"] = $oi->orderItemId;
                $res["cart"] = $cart;
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

    public function actionSaveSlowest() {
        if (isset($_POST['orderId'])) {
            $order = \common\models\costfit\Order::find()->where("orderId=" . $_POST['orderId'])->one();
            if (isset($order)) {
                if ($_POST['type'] == 1) {
                    $order->isSlowest = 1;
                } else {
                    $order->isSlowest = 0;
                }
                $order->save(false);
            }
        }
        echo $_POST['orderId'];
    }

}
