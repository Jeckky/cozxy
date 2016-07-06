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
 * Register controller
 */
class RegisterController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        //return Yii::$app->getResponse()->redirect('register/login');
        $this->title = 'Cost.fit | Register Login';
        $this->subTitle = 'Register Login';
        return $this->render('register/Login');
    }

    public function actionLogin() {
        $this->title = 'Cost.fit | Register Login';
        $this->subTitle = 'Register Login';
        return $this->render('register');
    }

    public function actionThank() {
        $this->title = 'Cost.fit | Register Thank';
        $this->subTitle = 'Register Thank';
        $this->subSubTitle = '';
        return $this->render('register_thank');
    }

    public function actionForgot() {
        $this->title = 'Cost.fit | Forgot password?';
        $this->subTitle = 'Forgot password?';
        $this->subSubTitle = '';
        return $this->render('register_forgot');
    }

}
