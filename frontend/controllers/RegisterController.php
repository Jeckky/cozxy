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
class RegisterController extends MasterController
{

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
//return Yii::$app->getResponse()->redirect('register/login');
        $this->title = 'Cost.fit | Register Login';
        $this->subTitle = 'Register Login';
        return $this->render('register/Login');
    }

    public function actionLogin()
    {
        $this->title = 'Cost.fit | Register Login';
        $this->subTitle = 'Register Login';
        return $this->render('register');
    }

    public function actionRegister()
    {
        $model = new \common\models\costfit\User();
        if (isset($_POST["User"])) {
            $model->attributes = $_POST["User"];
            $model->username = $_POST["User"]['email'];
            $model->status = 0;
            $model->token = Yii::$app->security->generateRandomString(10);
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($_POST["User"]['password'] == $_POST["User"]['confirmPassword']) {
                if (!isset($_POST["User"]['acceptTerm'])) {
                    $model->addError("acceptTerm", 'Please Accept Term&Condition');
                } else {
                    $model->save();
                }
            } else {
                $model->addError("password", 'Confirm password not match');
            }
        }
        return $this->render('register', ['model' => $model]);
    }

    public function actionThank()
    {
        $this->title = 'Cost.fit | Register Thank';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Register Thank';
        return $this->render('register_thank');
    }

    public function actionForgot()
    {
        $this->title = 'Cost.fit | Forgot password?';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Forgot password?';
        return $this->render('register_forgot');
    }

}
