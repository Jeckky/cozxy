<?php

namespace frontend\controllers;

use common\models\ModelMaster;
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
use \common\models\costfit\Order;

/**
 * Checkout controller
 */
class CheckoutController extends MasterController {

    public $enableCsrfValidation = false;

    public function beforeAction($action) {
        if ($action->id == 'confirmation' || $action->id == 'confirm-checkout') {
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
        if (Yii::$app->user->isGuest == 1) {
            //return Yii::$app->response->redirect(Yii::$app->homeUrl . 'register/login');
        }
        $this->layout = "/content_right";
        $this->title = 'Cost.fit | checkout';
        $this->subTitle = 'Checkout';
        $this->subSubTitle = "";

        if (\Yii::$app->user->isGuest) {
            $user = new \common\models\costfit\User();
        } else {
            $user = \common\models\costfit\User::find()->where('userId=' . \Yii::$app->user->id)->one();
        }

        $addressId = Yii::$app->request->post('addressId');
        $address = new \common\models\costfit\Address();
        $address->scenario = 'shipping_address';
        if (isset($addressId)) { // ตรวจสอบว่า มี hidden addressId ให้ update ในเทเบิล address
            if (isset($_POST['Address'])) {
                $address = \common\models\costfit\Address::find()
                        ->where('userId =' . \Yii::$app->user->id . ' and addressId=' . $addressId)
                        ->one();

                //$address->attributes = $_POST['Address'];
                $address->countryId = (isset($_POST['Address']['countryId']) ? $_POST['Address']['countryId'] : '');
                $address->provinceId = (isset($_POST['Address']['provinceId']) ? $_POST['Address']['provinceId'] : '');
                $address->amphurId = (isset($_POST['Address']['amphurId']) ? $_POST['Address']['amphurId'] : '');
                $address->districtId = (isset($_POST['Address']['districtId']) ? $_POST['Address']['districtId'] : '');

                if ($address->save(FALSE)) {
                    $this->redirect(Yii::$app->homeUrl . 'checkout');
                }
            }
        } else {

            if (\Yii::$app->user->isGuest) {
                $address_shipping = \common\models\costfit\Address::find()->where('userId=' . 0 . ' and type = 2  ')
                        ->orderBy('isDefault desc ')
                        ->all();

                $address_billing = \common\models\costfit\Address::find()->where('userId=' . 0 . ' and type = 1  ')
                        ->orderBy('isDefault desc  ')
                        ->all();
            } else {
                $address_shipping = \common\models\costfit\Address::find()->where('userId=' . \Yii::$app->user->id . ' and type = 2  ')
                        ->orderBy('isDefault desc ')
                        ->all();

                $address_billing = \common\models\costfit\Address::find()->where('userId=' . \Yii::$app->user->id . ' and type = 1  ')
                        ->orderBy('isDefault desc  ')
                        ->all();
            }

            $paymentMethods = \common\models\costfit\PaymentMethod::find()->where("status = 1")->all();

            if (isset($_POST["Order"])) {
                $this->redirect(['order-thank']);
            }

            if (isset($_POST['Address'])) {
                // print_r($_POST['Address']);
                //exit();

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
    }

    public function actionOrderThank() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl . 'register/login');
        }
        $this->title = 'Cost.fit | Order Thank';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Order Thank';
        return $this->render('order_thank');
    }

    public function actionBurnCheckouts() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl . 'register/login');
        }
        /*
          Order
          - paymentType
          - status  = 2
         */
        $request = Yii::$app->request;

        if (isset($request)) {
            //$model->attributes = $_POST['Address'];
            $shipping = Yii::$app->request->post('shipping');
            $billing = Yii::$app->request->post('billing');
            $payment01 = Yii::$app->request->post('payment01');
            $placeUserId = (Yii::$app->request->post('placeUserId') != '') ? Yii::$app->request->post('placeUserId') : \Yii::$app->user->id;
            $notes = Yii::$app->request->post('notes');
            $placeOrderId = Yii::$app->request->post('placeOrderId');

            // echo 'billing : ' . $billing;

            if (isset($billing)) {
                $address_billing = \common\models\costfit\Address::find()->where('userId=' . $placeUserId . ' and addressId =' . $billing)
                        ->orderBy('addressId desc')
                        ->one();
                $address_shipping = \common\models\costfit\Address::find()->where('userId=' . $placeUserId . ' and addressId = ' . $shipping)
                        ->orderBy('addressId desc')
                        ->one();
            } else {
                $address_shipping = \common\models\costfit\Address::find()->where('userId=' . $placeUserId . ' and addressId = ' . $shipping)
                        ->orderBy('addressId desc')
                        ->one();
                $address_billing = \common\models\costfit\Address::find()->where('userId=' . $placeUserId . ' and addressId = ' . $shipping)
                        ->orderBy('addressId desc')
                        ->one();
            }

            $order = \common\models\costfit\Order::find()->where('userId= ' . $placeUserId . ' and orderId = ' . $placeOrderId)->one();
            $order->orderNo = \common\models\costfit\Order::genOrderNo();

            //echo "<pre>";
            //print_r($order->orderNo);
            // exit();
            $order->paymentType = $payment01;
            $order->status = 2;
            $order->userId = $placeUserId;
            $order->updateDateTime = new \yii\db\Expression("NOW()");
            $order->billingCompany = ($address_billing['company'] != '') ? $address_billing['company'] : '';
            $order->shippingTax = ($address_billing['tax'] != '') ? $address_billing['tax'] : '';
            $order->billingAddress = ($address_billing['address'] != '') ? $address_billing['address'] : '';
            $order->billingCountryId = ($address_billing['countryId'] != '') ? $address_billing['countryId'] : '';
            $order->billingProvinceId = ($address_billing['provinceId'] != '') ? $address_billing['provinceId'] : '';
            $order->billingAmphurId = ($address_billing['amphurId'] != '') ? $address_billing['amphurId'] : '';
            $order->billingZipcode = ($address_billing['zipcode'] != '') ? $address_billing['zipcode'] : '';
            $order->billingTel = ($address_billing['tel'] != '') ? $address_billing['tel'] : '';
            $order->shippingCompany = ($address_shipping['company'] != '') ? $address_shipping['company'] : '';
            $order->shippingTax = ($address_shipping['tax'] != '') ? $address_shipping['tax'] : '';
            $order->shippingAddress = ($address_shipping['address'] != '') ? $address_shipping['address'] : '';
            $order->shippingCountryId = ($address_shipping['countryId'] != '') ? $address_shipping['countryId'] : '';
            $order->shippingProvinceId = ($address_shipping['provinceId'] != '') ? $address_shipping['provinceId'] : '';
            $order->shippingAmphurId = ($address_shipping['amphurId'] != '') ? $address_shipping['amphurId'] : '';
            $order->shippingZipcode = ($address_shipping['zipcode'] != '') ? $address_shipping['zipcode'] : '';
            $order->shippingTel = ($address_shipping['tel'] != '') ? $address_shipping['tel'] : '';


            if ($order->paymentType == 2) {
                $order->status = \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_DRAFT;
            }
            if ($order->save(FALSE)) {

                if ($order->paymentType == 1) {
                    $this->redirect(Yii::$app->homeUrl . 'checkout/order-thank');
                } else {
                    // $order->encodeParams(['orderId'=>$orderId->orderId])
                    //$this->redirect(Yii::$app->homeUrl . 'checkout/confirm-checkout?orderId=' . $order->orderId);
                    //echo $order->orderId;
                    //echo $order->encodeParams(['orderId' => $order->orderId]);
                    //exit();
                    $this->redirect(Yii::$app->homeUrl . 'checkout/confirm-checkout/' . $order->encodeParams(['orderId' => $order->orderId]));
                }
            }
        } else {
            $this->redirect(Yii::$app->homeUrl . 'cart');
        }
    }

    public function actionGetAddress() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl . 'register/login');
        }
        $addressId = Yii::$app->request->post('address');
        $address = \common\models\costfit\Address::find()->where('addressId = ' . $addressId)
                ->orderBy('isDefault desc, updateDateTime desc')
                ->one();
        //echo '<pre>';
        //print_r($address->attributes);
        echo json_encode($address->attributes);
    }

    public function actionConfirmCheckout($hash) {

        $k = base64_decode(base64_decode($hash));
        $params = ModelMaster::decodeParams($hash);
        $orderId = $params['orderId'];
        $model = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->one();
        //$model = \common\models\costfit\Order::find()->where("orderId=" . $_GET["orderId"])->one();
        $ePayment = \common\models\costfit\EPayment::find()->where("PaymentMethodId = 2 AND type =" . \Yii::$app->params['ePaymentServerType'])->one();
        return $this->render('_confirm_checkout', compact('model', 'ePayment'));
    }

    public function actionConfirmation($hash) {

        $k = base64_decode(base64_decode($hash));
        $params = ModelMaster::decodeParams($hash);
        //echo '<pre>';
        //print_r($params);
        //exit();
        $orderId = $params['orderId'];
        $model = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->one();
        $ePayment = \common\models\costfit\EPayment::find()->where("PaymentMethodId = 2 AND type =" . \Yii::$app->params['ePaymentServerType'])->one();
        return $this->render("//e_payment/payment_confirmation", [
                    'model' => $model,
                    'ePayment' => $ePayment]);
    }

    public function actionResult() {
        $this->title = 'Cost.fit | Order Thank';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Order Thank';
        $res = [];
//        throw new \yii\base\Exception(print_r($_REQUEST, TRUE));
        if (isset($_REQUEST) && $_REQUEST != array()) {
            $order = Order::find()->where("orderNo='" . $_REQUEST["req_reference_number"] . "'")->one();
            if ($_REQUEST["decision"] == "ACCEPT") {
                $order->invoiceNo = Order::genInvNo($order);
                $order->status = Order::ORDER_STATUS_E_PAYMENT_SUCCESS;
                $order->paymentDateTime = new \yii\db\Expression('NOW()');
                if ($order->save()) {
                    $res["status"] = 1;
                    $res["invoiceNo"] = $order->invoiceNo;
                    $res["message"] = \common\models\costfit\EPayment::getReasonCodeText($_POST["reason_code"]);
                }
            } else if ($_REQUEST["decision"] == "REVIEW") {
                $order->status = Order::ORDER_STATUS_E_PAYMENT_PENDING;
                $order->save();
                $res["status"] = 2;
                $res["message"] = \common\models\costfit\EPayment::getReasonCodeText($_POST["reason_code"]);
            } else {
                $order->status = Order::ORDER_STATUS_E_PAYMENT_DRAFT;
                $order->save();
                $res["status"] = 3;
                $res["message"] = \common\models\costfit\EPayment::getReasonCodeText($_POST["reason_code"]);
            }
            Order::saveOrderPaymentHistory($order, $_REQUEST["decision"], $_POST["reason_code"], $_POST['score_device_fingerprint_true_ipaddress']);
        }

        return $this->render('payment_result', compact('res'));
    }

}
