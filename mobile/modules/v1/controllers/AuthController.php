<?php

namespace mobile\modules\v1\controllers;

use common\models\costfit\User;
use yii\web\Controller;
use \yii\helpers\Json;
use Yii;
use common\models\LoginForm;

/**
 * Default controller for the `mobile` module
 */
class AuthController extends Controller
{

   public $enableCsrfValidation = false;

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
        $res = ['success'=>false, 'error'=>''];

        $model = new LoginForm();
        $model->email = $_POST['username'];
        $model->password = $_POST['password'];

        if ($model->login()) {
            if (\Yii::$app->user->identity->type == 1 || \Yii::$app->user->identity->type == 3) {
                $userModel = User::findOne(Yii::$app->user->id);
                $userModel->auth_key = Yii::$app->security->generateRandomString();
                $userModel->save(false);


                $res['user']["email"] = Yii::$app->user->identity->email;
                $res['user']["firstname"] = Yii::$app->user->identity->firstname;
                $res['user']["lastname"] = Yii::$app->user->identity->lastname;
                $res['user']["type"] = Yii::$app->user->identity->type;
//                $res['user']["gender"] = Yii::$app->user->identity->gender;
//                $res['user']["passportNo"] = Yii::$app->user->identity->passportNo;
//                $res['user']["passportImage"] = Yii::$app->user->identity->passportImage;
//                $res['token'] = $userModel->auth_key;
                $res['token'] = Yii::$app->user->identity->getAuthKey();
                $res['success'] = true;

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
        print_r(Json::encode($res));
    }

    public function actionLogout()
    {
        $res = ['success'=>false, 'error'=>''];
        $username = $_POST['username'];
        $token = $_POST['token'];

        $userModel = User::find()->where(['username'=>$username, 'auth_key'=>$token])->one();

        if($userModel) {
            $userModel->auth_key = Yii::$app->security->generateRandomString();
            $userModel->save(false);
            $res['success'] = true;
        }

        print_r(Json::encode($res));
    }

    public function actionResetPassword()
    {
        $res = ['success'=>false, 'error'=>''];
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
