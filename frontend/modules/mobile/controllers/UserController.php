<?php

namespace frontend\modules\mobile\controllers;

use yii\web\Controller;
use \yii\helpers\Json;
use Yii;
use common\models\LoginForm;

/**
 * Default controller for the `mobile` module
 */
class UserController extends Controller
{

    public function beforeAction($action)
    {
        if ($action->id == 'login') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $res = [];

        $model = new LoginForm();

        $model->email = 'nattawoot@cozxy.com';
//	    $model->username = 'nattawoot@cozxy.com';
        $model->password = 'ktkt1234';
//        $_POST['LoginForm']['username'] = 'nattawoot@cozxy.com';
//	    $_POST['LoginForm']['email'] = 'nattawoot@cozxy.com';
//	    $_POST['LoginForm']['password'] = 'ktkt1234';
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
        if ($model->login()) {
            if (\Yii::$app->user->identity->type == 1 || \Yii::$app->user->identity->type == 3) {
                $res["email"] = Yii::$app->user->identity->email;
                $res["firstname"] = Yii::$app->user->identity->firstname;
                $res["lastname"] = Yii::$app->user->identity->lastname;
                $res["type"] = Yii::$app->user->identity->type;
                $res["gender"] = Yii::$app->user->identity->gender;
                $res["passportNo"] = Yii::$app->user->identity->passportNo;
                $res["passportImage"] = Yii::$app->user->identity->passportImage;
                $res['result'] = true;

                /**
                 * return cart array
                 */
                $cartArray = \common\models\costfit\Order::findCartArray();
                $res["cart"] = $cartArray;
            } else {
                $res["error"] = "บัญชีของท่านไม่มีสิทธิ์เข้าใช้งาน";
                $res['result'] = false;
            }
        } else {
            $res["error"] = "อีเมล์ หรือ รหัสผ่าน ไม่ถูกต้อง";
            $res['result'] = false;
        }
//        return $this->render('index');
        print_r(Json::encode($res));
    }

    public function actionLogout()
    {
        $res = [];
        Yii::$app->user->logout();
        $res['error'] = NULL;
        print_r(Json::encode($res));
    }

    public function actionResetPassword()
    {
        $res = [];
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                $res['error'] = NULL;
            } else {
                $res['error'] = "Sorry, we are unable to reset password for email provided.";
            }
        }

        print_r(Json::encode($res));
    }

    public function actionRegister()
    {
        $res = [];
        $model = new \common\models\costfit\User(['scenario' => 'register']);
        $loginForm = new \common\models\LoginForm();
        $ms = '';
        if (isset($_GET['ms'])) {
            $res['error'] = 'เนื่องจากบัญชี facebook นี้ไม่ได้ใช้ email ในการสมัคร กรุณาสมัครสมาชิกเพื่อเข้าใช้งาน';
        }
        if (isset($_POST["User"])) {
            $model->attributes = $_POST["User"];
            $model->username = $_POST["User"]['email'];
            $user = new \common\models\User();
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            $model->status = 0;
            $model->token = Yii::$app->security->generateRandomString(10);
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($_POST["User"]['password'] == $_POST["User"]['confirmPassword']) {
                if (!isset($_POST["User"]['acceptTerm'])) {
                    $res['error'] = 'Please Accept Term&Condition';
                } else {
                    if ($model->save()) {
                        $emailSend = new \frontend\controllers\EmailSend();
                        $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "register/confirm?token=" . $model->token;
                        $toMail = $model->email;
                        $emailSend->mailRegisterConfirm($toMail, $url);
                        $res['error'] = NULL;
                    } else {
//                        throw new \yii\base\Exception(print_r($model->errors, true));
                    }
                }
            } else {
                $res['error'] = 'Confirm password not match';
            }
        }
        $term = \common\models\costfit\ContentGroup::find()->where("lower(title)='term'")->one();
        $res['attributes'] = $model->attributes;
        $res['termTitle'] = $term->contents[0]->title;
        $res['termDescription'] = $term->contents[0]->description;
        print_r(Json::encode($res));
    }

}
