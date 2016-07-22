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
        return $this->render('checkout', compact('address', 'user', 'paymentMethods', 'address_shipping', 'address_billing'));
    }

    public function actionOrderThank() {
        $this->title = 'Cost.fit | Order Thank';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Order Thank';
        return $this->render('order_thank');
    }

}
