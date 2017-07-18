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

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                ['firstname', 'required'],
                ['lastname', 'required'],
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
                [['firstname', 'lastname', 'email', 'password', 'confirmPassword'], 'required', 'on' => self::COZXY_REGIS],
                ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Confirm Passwords don't match"],
        ];
    }

    public function scenarios() {
        return [
            self::COZXY_REGIS => ['firstname', 'lastname', 'email', 'password', 'confirmPassword'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->username = $this->email;
        $user->setPassword($this->password);
        $user->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
        $user->email = $this->email;
        $user->gender = $this->gender;
        $user->birthDate = $this->birthDate;
        $user->status = 0;
        $user->token = \Yii::$app->security->generateRandomString(10);
        $user->lastvisitDate = new \yii\db\Expression("NOW()");
        $user->createDateTime = new \yii\db\Expression("NOW()");
        $user->generateAuthKey();
        if ($user->save()) {
            $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "site/confirm?token=" . $user->token;
            $toMail = $user->email;
            $emailSend = \common\helpers\Email::mailRegisterConfirm($toMail, $url);
            return $user;
        } else {
            return null;
        }
        //return $user->save(FALSE) ? $user : null;
    }

}
