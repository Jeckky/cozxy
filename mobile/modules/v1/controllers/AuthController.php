<?php

namespace mobile\modules\v1\controllers;

use common\models\costfit\User;
use frontend\models\SignupForm;
use yii\helpers\Url;
use yii\web\Controller;
use \yii\helpers\Json;
use Yii;
use common\models\LoginForm;
use common\helpers\Email;
use mobile\modules\v1\models\ProductShelf;

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
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => ''];

        $model = new LoginForm();
        $model->email = $contents['username'];
        $model->password = $contents['password'];

        if($model->login()) {
            if(\Yii::$app->user->identity->type == 1 || \Yii::$app->user->identity->type == 3) {
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
                $res['token'] = $userModel->auth_key;
                $res['birthDate'] = $userModel->birthDate;
                $res['avatar'] = Yii::$app->homeUrl . $userModel->avatar;
                $res['mobile'] = $userModel->tel;
                $res['success'] = true;

                /**
                 * return cart array
                 */
                $cartArray = \common\models\costfit\Order::findCartArray();
                $res["cart"] = $cartArray;

                $productShelfs = ProductShelf::find()
                    ->where(['userId' => $userModel->userId, 'status' => 1])
                    ->andWhere('type!=2')
//                ->limit($this->pageSize)
//                ->offset($offset)
                    ->all();

                $j = 0;
                $items = [];
                foreach($productShelfs as $productShelf) {
                    $shelf = [
                        'productShelfId' => $productShelf->productShelfId,
                        'title' => $productShelf->title,
                    ];
                    //Cozxy shelve
                    $items[$j] = $shelf;
                    $j++;
                }
                $res['cozxyShelves'] = $items;
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
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => ''];
        $username = $contents['username'];
        $token = $contents['token'];

        $userModel = User::find()->where(['username' => $username, 'auth_key' => $token])->one();

        if($userModel) {
            $userModel->auth_key = Yii::$app->security->generateRandomString();
            $userModel->save(false);
            $res['success'] = true;
        }

        print_r(Json::encode($res));
    }

    public function actionResetPassword()
    {
        $res = ['success' => false, 'error' => ''];
        $model = new PasswordResetRequestForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->sendEmail()) {
                $res['error'] = NULL;
            } else {
                $res['error'] = "Sorry, we are unable to reset password for email provided.";
            }
        }

        print_r(Json::encode($res));
    }

    public function actionRegistera()
    {
        $res = [];
        $model = new \common\models\costfit\User(['scenario' => 'register']);
        $loginForm = new \common\models\LoginForm();
        $ms = '';
        if(isset($_GET['ms'])) {
            $res['error'] = 'เนื่องจากบัญชี facebook นี้ไม่ได้ใช้ email ในการสมัคร กรุณาสมัครสมาชิกเพื่อเข้าใช้งาน';
        }
        if(isset($_POST["User"])) {
            $model->attributes = $_POST["User"];
            $model->username = $_POST["User"]['email'];
            $user = new \common\models\User();
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            $model->status = 0;
            $model->token = Yii::$app->security->generateRandomString(10);
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if($_POST["User"]['password'] == $_POST["User"]['confirmPassword']) {
                if(!isset($_POST["User"]['acceptTerm'])) {
                    $res['error'] = 'Please Accept Term&Condition';
                } else {
                    if($model->save()) {
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

    public function actionForgetPassword()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => ''];
        $forget = $contents['forget'];
        $user = \common\models\costfit\User::find()->where('email = "' . $forget . '  " ')->one();
        if(count($user) > 0) {
            if($user['status'] == 1) {
                $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "site/forget-confirm?token=" . $user->token . '::' . $user->email;
                $toMail = $user->email;
                Email::mailForgetPassword($toMail, $url);
                $res['success'] = true;
            } else {
                $res['error'] = 'Your email is invalid';
            }
        } else {
            $res['error'] = 'Your email not found.';
        }

        return Json::encode($res);
    }

    public function actionRegister()
    {
        $contents = Json::decode(file_get_contents("php://input"));

        if(isset($contents) && $contents !== []) {
            $res = ['success' => false, 'error' => '', 'msg' => ''];

            $userCount = User::find()->where(['email' => $contents['email']])->count();

            if($userCount) {
                $res['error'] = 'Duplicate email address.';
            } else {
                $signupModel = new SignupForm(['scenario' => SignupForm::COZXY_MOBILE_REGIS]);
                $signupModel->attributes = $contents;
//                $signupModel->birthDate = $contents['birthDate'];

                $user = $signupModel->signup();

                if(isset($user)) {
                    $res['success'] = true;
                    $res['msg'] = 'Register complete : Plase verify your email to complete your registration';
                } else {
                    //register faild
                    $res['error'] = 'Error : can not register at this time, please try again.';
                }
            }

            return Json::encode($res);
        }
    }

    public function actionChangePassword()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        if(isset($contents) && $contents !== []) {
            $res = ['success' => false, 'error' => ''];

            $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

            if(isset($userModel)) {
                if(Yii::$app->security->validatePassword($contents['currentPassword'], $userModel->password_hash)) {
                    //change password
                    $userModel->password_hash = Yii::$app->security->generatePasswordHash($contents['newPassword']);
                    $userModel->save(false);
                    $res['success'] = true;
                } else {
                    $res['error'] = 'Error : Password miss match';
                }
            } else {
                $res['error'] = 'User not found.';
            }

            return Json::encode($res);
        }
    }

    public function actionSessionCheck()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => ''];

        if(isset($contents['token']) && !empty($contents['token']))  {
            $userModel = User::find()
                ->select('firstname, lastname, displayName, email, birthDate, avatar')
                ->where(['auth_key' => $contents['token']])
                ->one();

            if(isset($userModel)) {
                $res['success'] = true;

                $res['user'] = [
                    'firstname'=>$userModel->firstname,
                    'lastname'=>$userModel->lastname,
                    'displayName'=>$userModel->displayName,
                    'email'=>$userModel->email,
                    'birthdate'=>substr($userModel->birthDate, 0, 10),
                    'avatar'=>(isset($userModel->avatar) && !empty($userModel->avatar)) ? Url::home(true).$userModel->avatar:'',
                ];
            }
        }

        return Json::encode($res);
    }
}
