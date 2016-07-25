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
 * Checkout controller
 */
class CheckoutController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        $this->layout = "/content_right";
        $this->title = 'Cost.fit | checkout';
        $this->subTitle = 'Checkout';
        $this->subSubTitle = "";
//$cookies = Yii::$app->request->cookies;
//$token = $this->getToken();
//echo $token;
//echo '<br>' . $cookies['orderToken'];


        $address = new \common\models\costfit\Address();
        if (\Yii::$app->user->isGuest) {
            $user = new \common\models\costfit\User();
        } else {
            $user = \common\models\costfit\User::find()->where('userId=' . \Yii::$app->user->id)->one();
        }

        $address_shipping = \common\models\costfit\Address::find()->where('userId=' . \Yii::$app->user->id . ' and type = 2  ')
                ->orderBy('isDefault desc, updateDateTime desc')
                ->all();

        $address_billing = \common\models\costfit\Address::find()->where('userId=' . \Yii::$app->user->id . ' and type = 1  ')
                ->orderBy('isDefault , updateDateTime desc')
                ->all();

        $paymentMethods = \common\models\costfit\PaymentMethod::find()->all();

        if (isset($_POST["Order"])) {
            $this->redirect(['order-thank']);
        }

        if (isset($_POST['Address'])) {

            if ($_POST['Address']['typeForm'] == 'formShipping') {
//$model_ = new \common\models\costfit\Address();
                $address->type = \common\models\costfit\Address::TYPE_SHIPPING; // default Address First
                $address->attributes = $_POST['Address'];
            }

            if ($_POST['Address']['typeForm'] == 'formBilling') {
//$model = new \common\models\costfit\Address();
                $address->type = \common\models\costfit\Address::TYPE_BILLING; // default Address First
                $address->attributes = $_POST['Address'];
            }

            if ($address->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'checkout');
            }
        }
        return $this->render('checkout', compact('address', 'user', 'paymentMethods', 'address_shipping', 'address_billing', 'model'));
    }

    public function actionOrderThank() {
        $this->title = 'Cost.fit | Order Thank';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Order Thank';
        return $this->render('order_thank');
    }

    public function actionBurnCheckouts() {
        /*
          Order
          - paymentType
          - status  = 2
         * shipping: _shipping,
          billing: _billing,
          payment01: _payment01,
          placeUserId: _placeUserId,
          notes: _notes
         */
        $request = Yii::$app->request;

        if (isset($request)) {
            //$model->attributes = $_POST['Address'];
            $shipping = Yii::$app->request->post('shipping');
            $billing = Yii::$app->request->post('billing');
            $payment01 = Yii::$app->request->post('payment01');
            echo $placeUserId = Yii::$app->request->post('placeUserId');
            $notes = Yii::$app->request->post('notes');
            echo $placeOrderId = Yii::$app->request->post('placeOrderId');

            $order = \common\models\costfit\Order::find()->where('userId = ' . $placeUserId . ' and orderId = ' . $placeOrderId)->one();
            //$order = \common\models\costfit\Order::find()->where(" userId =  $placeUserId   ")->one();
            $order->paymentType = $payment01;
            $order->status = 2;
            echo 'xxxx';
            echo '<pre>';
            print_r($order);
        }
        // echo '<pre>';
        //print_r($user);
        echo $order->orderId . '<br>';
        echo $order->userId . '<br>';
        echo 'shipping :' . $shipping . '<br>';
        echo 'billing : ' . $billing . '<br>';
        echo 'payment01 : ' . $payment01 . '<br>';
        echo 'placeUserId : ' . $placeUserId . '<br>';
        echo 'notes :' . $notes . '<br>';
        echo 'notes :' . $placeOrderId . '<br>';
        if ($user->save(FALSE)) {
            $this->redirect(Yii::$app->homeUrl . 'checkout/order-thank');
        }
    }

}
