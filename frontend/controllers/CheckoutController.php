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

        $address = new \common\models\costfit\Address();
        if (\Yii::$app->user->isGuest) {
            $user = new \common\models\costfit\User();
        } else {
            $user = \common\models\costfit\User::find()->where('userId=' . \Yii::$app->user->id)->one();
        }

        $addressId = Yii::$app->request->post('addressId');
        if (isset($addressId)) { // ตรวจสอบว่า มี hidden addressId ให้ update ในเทเบิล address
            if (isset($_POST['Address'])) {
                $address = \common\models\costfit\Address::find()
                        ->where('userId =' . \Yii::$app->user->id . ' and addressId=' . $addressId)
                        ->one();
                $address->attributes = $_POST['Address'];

                if ($address->save(FALSE)) {
                    $this->redirect(Yii::$app->homeUrl . 'checkout');
                }
            }
        } else {
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
            $placeUserId = Yii::$app->request->post('placeUserId');
            $notes = Yii::$app->request->post('notes');
            $placeOrderId = Yii::$app->request->post('placeOrderId');

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
                $address_billing = NULL;
            }

            $order = \common\models\costfit\Order::find()->where('userId= ' . $placeUserId . ' and orderId = ' . $placeOrderId)->one();
            $order->paymentType = $payment01;
            $order->status = 2;
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

            // echo '<pre>';
            //print_r($order);
            if ($order->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'checkout/order-thank');
            }
        } else {
            $this->redirect(Yii::$app->homeUrl . 'cart');
        }
    }

    public function actionGetAddress() {

        $addressId = Yii::$app->request->post('address');
        $address = \common\models\costfit\Address::find()->where('addressId = ' . $addressId)
                ->orderBy('isDefault desc, updateDateTime desc')
                ->one();
        //echo '<pre>';
        //print_r($address->attributes);
        echo json_encode($address->attributes);
    }

}
