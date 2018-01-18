<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model {

    const COZXY_REGIS = 'register';
    const COZXY_BOOTH_REGIS = 'registerBooth';
    const COZXY_MOBILE_REGIS = 'registerBooth';

    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $password;
    public $gender;
    public $birthDate;
    public $confirmPassword;
    public $yyyy;
    public $mm;
    public $dd;
    public $cz;
    public $tel;
    public $group;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['firstname', 'required'],
            ['lastname', 'required'],
            ['gender', 'required'],
            ['birthDate', 'required'],
            //['yyyy', 'required'],
            //['mm', 'required'],
            //['dd', 'required'],
            ['tel', 'required'],
            ['tel', 'string', 'min' => 10],
            [['birthday'], 'safe'],
            ['birthDate', 'required', 'message' => 'BirthDate cannot be blank.'],
            ['dd', 'required', 'message' => 'Date cannot be blank.'],
            ['mm', 'required', 'message' => 'Month cannot be blank.'],
            ['yyyy', 'required', 'message' => 'Year cannot be blank.'],
            //['birthDate', 'date', 'format' => 'yyyy-mm-dd'],
            //['birthDate', 'isValidDate'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 8],
            //['email', 'unique'],
            'tel' => [['tel'], 'string'],
            ['newPassword', 'string', 'min' => 8],
            ['password', 'string', 'min' => 8],
            ['rePassword', 'required', 'message' => 'Re Password must be equal to "New Password".'],
            [['firstname', 'lastname', 'email', 'password', 'confirmPassword', 'dd', 'mm', 'yyyy'], 'required', 'on' => self::COZXY_REGIS],
            [['firstname', 'lastname', 'tel', 'email', 'password', 'confirmPassword'], 'required', 'on' => self::COZXY_BOOTH_REGIS],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Confirm Passwords don't match"],
        ];
    }

    public function scenarios() {
        return [
            self::COZXY_REGIS => ['firstname', 'lastname', 'email', 'password', 'confirmPassword', 'gender', 'dd', 'mm', 'yyyy'],
            self::COZXY_BOOTH_REGIS => ['firstname', 'lastname', 'tel', 'email', 'password', 'confirmPassword'],
                //self::COZXY_MOBILE_REGIS => ['firstname', 'lastname', 'tel', 'email', 'password', 'gender', 'birthDate'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        //echo 'birthDate :' . $this->birthDate . '<br>';
        //print_r($this->validate());
        $otp_code = strtoupper(substr(md5(uniqid()), 0, 6));   // A smart code to generate OTP PIN.
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->username = $this->email;
        $user->setPassword($this->password);
        $user->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
        if ($this->group == 'booth') {
            $user->password = $otp_code;
        }
        $user->email = $this->email;
        $user->gender = $this->gender;
        $user->birthDate = $this->birthDate;
        $user->status = 0;
        $user->tel = isset($this->tel) ? $this->tel : '';
        $user->token = \Yii::$app->security->generateRandomString(10);
        $user->lastvisitDate = new \yii\db\Expression("NOW()");
        $user->createDateTime = new \yii\db\Expression("NOW()");
        $user->generateAuthKey();
        if ($user->save()) {

            if ($this->group == 'booth') {

                $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "booth/confirm?token=" . $user->token;
                $toMail = $user->email;
                $emailSend = \common\helpers\Email::mailRegisterConfirmBooth($toMail, $url);
                $input = $user->tel;
                $output = '66' . substr($input, -9, -7) . substr($input, -7, -4) . substr($input, -4);
                //$this->SendSms($input);
                $msg = $otp_code . ' คือรหัสยืนยันเข้าใช้งานของคุณ';
                $url = "http://api.ants.co.th/sms/1/text/single";
                $method = "POST";
                $data = json_encode(array(
                    "from" => "Cozxy OTP",
                    //"to" => ["66937419977", "66616539889", "66836134241"],
                    //"to" => ["66937419977"],
                    "to" => [$output],
                    "text" => $msg)
                );
                $response = \common\helpers\Sms::Send($method, $url, $data);
                //echo '<pre>';
                //print_r($data);
                //exit();
            } else {
                if (isset($this->cz) && !empty($this->cz)) {//Redirect ไปหน้า Cart
                    $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "site/confirm?token=" . $user->token . '&cz=' . $this->cz;
                } else {
                    $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "site/confirm?token=" . $user->token;
                }
                $toMail = $user->email;

                $emailSend = \common\helpers\Email::mailRegisterConfirmBooth($toMail, $url);
            }
            return $user;
        } else {
            return null;
        }
        //return $user->save(FALSE) ? $user : null;
    }

    public static function SendSmsTest($tel) {
        $msg = 'ทดสอบการส่ง ข้อความของ www.cozxy.com';
        $url = "http://api.ants.co.th/sms/1/text/single";
        $method = "POST";
        $data = json_encode(array(
            "from" => "Test",
            //"to" => ["66937419977", "66616539889", "66836134241"],
            //"to" => ["66937419977"],
            "to" => [$tel],
            "text" => $msg)
        );

        $response = \common\helpers\Sms::Send($method, $url, $data);
        return $response;
        /* return $this->render('sms', [
          'response' => $response,
          'msg' => $msg,
          ]); */
    }

}
