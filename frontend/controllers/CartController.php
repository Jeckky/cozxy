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
class CartController extends MasterController
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "/content_right";
        $this->title = 'Cost.fit | cart';
        $this->subTitle = 'Shopping Cart';
        $this->subSubTitle = '';
        return $this->render('cart');
    }

    public function actionAddToCart($id)
    {
        $res = [];
//        if (\Yii::$app->user->isGuest) {
        $token = \Yii::$app->session->get("orderToken");
        $order = \common\models\costfit\Order::find()->where("token ='" . $token . "' AND status = " . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
//        } else {
//            $order = \common\models\costfit\Order::find()->where("userId =" . \Yii::$app->user->id . " AND status = " . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
//        }
        if (!isset($order)) {
            $order = new \common\models\costfit\Order();
            $order->token = $token;
            $order->status = \common\models\costfit\Order::ORDER_STATUS_DRAFT;
            $order->createDateTime = new \yii\db\Expression("NOW()");
            if (!$order->save(FALSE)) {
                throw new \yii\base\Exception("Can't Save Order");
            }
        }
        $orderItem = \common\models\costfit\OrderItem::find()->where("orderId = " . $order->orderId . " AND productId =" . $id)->one();
        if (!isset($orderItem)) {
            $orderItem = new \common\models\costfit\OrderItem();
            $orderItem->quantity = $_POST["quantity"];
        } else {
            $orderItem->quantity = $orderItem->quantity + $_POST["quantity"];
        }
        $orderItem->orderId = $order->orderId;
        $orderItem->productId = $id;
        $orderItem->price = $orderItem->product->calProductPrice($id, $_POST["quantity"]);
        $orderItem->total = $orderItem->quantity * $orderItem->price;
        $orderItem->createDateTime = new \yii\db\Expression("NOW()");
        if ($orderItem->save()) {
            $res["status"] = TRUE;
        } else {
            $res["status"] = FALSE;
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionDeleteCartItem($id)
    {
        $res = [];

        if (\common\models\costfit\OrderItem::deleteAll("orderItemId = $id") > 0) {
            $res["status"] = TRUE;
            $res["cart"] = \common\models\costfit\Order::findCartArray();
        } else {
            $res["status"] = FALSE;
        }

        return \yii\helpers\Json::encode($res);
    }

}
