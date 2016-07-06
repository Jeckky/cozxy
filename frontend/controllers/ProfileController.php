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
 * Profile controller
 */
class ProfileController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | My Profile';
        $this->subTitle = 'Home';
        $this->subSubTitle = "My Profile";
        return $this->render('profile');
    }

    public function actionPayment() {
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Payment';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Payment Methods";
        return $this->render('@app/views/payment/payment');
    }

    public function actionOrder() {
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Order History';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order History";
        return $this->render('@app/views/profile/order_history');
    }

}
