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
use common\helpers\Email;

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
        $this->title = 'Cozxy.com | Register Login';
        $this->subTitle = 'Register Login';
        return $this->render('register/Login');
    }

    public function actionLogin() {
        $model = new \common\models\costfit\User(['scenario' => 'register']);
        $term = \common\models\costfit\ContentGroup::find()->where("lower(title)='term'")->one();
        $loginForm = new \common\models\LoginForm();
        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->login()) {
            \common\models\costfit\User::updateAll(['lastvisitDate' => new \yii\db\Expression("NOW()")], ['userId' => Yii::$app->user->identity->userId]);
            //Detect special conditions devices
            $devices = \common\helpers\GetBrowser::UserAgent();
            $article = new \common\models\costfit\UserVisit(); //Create an article and link it to the author
            $article->userId = Yii::$app->user->identity->userId;

            $article->device = $devices;
            $article->lastvisitDate = new \yii\db\Expression('NOW()');
            $article->createDateTime = new \yii\db\Expression('NOW()');
            $article->save(FALSE);

            //exit();
            //return $this->redirect(['site/index']);
            return $this->redirect(Yii::$app->homeUrl);
        } else {
//            throw new \yii\base\Exception(print_r($loginForm->errors, true));
        }
        $this->title = 'Cozxy.com | Register Login';
        $this->subTitle = 'Register Login';
        return $this->render('register', ['model' => $model, 'loginForm' => $loginForm, 'term' => $term]);
    }

    public function actionRegister() {
        $model = new \common\models\costfit\User(['scenario' => 'register']);
        $loginForm = new \common\models\LoginForm();
        $ms = '';
        if (isset($_GET['ms'])) {
            $ms = 'เนื่องจากบัญชี facebook นี้ไม่ได้ใช้ email ในการสมัคร กรุณาสมัครสมาชิกเพื่อเข้าใช้งาน';
        }
        if (isset($_POST["User"])) {
            $model->attributes = $_POST["User"];
            $model->username = $_POST["User"]['email'];
            $user = new \common\models\User();
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            $model->status = 0;
            //$model->password = NULL;
            $model->token = Yii::$app->security->generateRandomString(10);
            $model->lastvisitDate = new \yii\db\Expression("NOW()");
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($_POST["User"]['password'] == $_POST["User"]['confirmPassword']) {
                if (!isset($_POST["User"]['acceptTerm'])) {
                    $model->addError("acceptTerm", 'Please Accept Term&Condition');
                } else {

                    if ($model->save()) {
                        //$emailSend = new \frontend\controllers\EmailSend();
                        //\common\models\costfit\User::find()->where('userId=' . Yii::$app->db->lastInsertID)->one();
                        \common\models\costfit\User::updateAll(['password' => NULL], ['userId' => Yii::$app->db->lastInsertID]);
                        $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "register/confirm?token=" . $model->token;
                        $toMail = $model->email;
                        $emailSend = Email::mailRegisterConfirm($toMail, $url);
                        //$emailSend->mailRegisterConfirm($toMail, $url);
                        return $this->redirect(['thank']);
                    } else {
                        // throw new \yii\base\Exception(print_r($model->errors, true));
                    }
                }
            } else {
                $model->addError("password", 'Confirm password not match');
            }
        }
        $term = \common\models\costfit\ContentGroup::find()->where("lower(title)='term'")->one();
        return $this->render('register', ['model' => $model, 'loginForm' => $loginForm, 'term' => $term, 'ms' => $ms]);
    }

    public function actionThank() {
        $this->title = 'Cozxy.com | Register New';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Register Thank';
        return $this->render('register_thank');
    }

    public function actionForgot() {
        $this->title = 'Cozxy.com | Forgot password?';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Forgot password?';
        return $this->render('register_forgot');
    }

    public function actionConfirm() {
        $this->title = 'Cozxy.com | Register Thank';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Register Thank';

        $user = \common\models\costfit\User::find()->where("token = '" . $_GET["token"] . "'")->one();
        if (isset($user)) {
            $user->status = 1;
            $user->save(FALSE);
            return $this->redirect(['login?verification=complete']);
        } else {

        }
    }

    public function actionCheckPassword() {
        $password = $_POST['password'];
        $res = [];
        $letter = 0;
        $number = 0;
        // throw new \yii\base\Exception($password[3]);
        $res["status"] = FALSE;
        $passwordLength = strlen($password);
        for ($i = 0; $i < $passwordLength; $i++):
            $char = substr($password, $i, 1);
            if (is_numeric($char)) {
                $number++;
            } else {
                $letter++;
            }
        endfor;
        // throw new \yii\base\Exception("number=>" . $number . " letter=>" . $letter);
        if ($passwordLength < 8) {
            $res["status"] = true;
            //$res["ms="] = $passwordLength;
            $res["ms"] = 'Password must be at least 8 characters.';
        } else if (($number == 0) || ($letter == 0)) {
            $res["status"] = true;
            $res["ms"] = 'Password must contain  numbers and letters.';
        }
        return \yii\helpers\Json::encode($res);
    }

}
