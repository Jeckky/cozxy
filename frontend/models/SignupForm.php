<?php

namespace frontend\models;

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
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            //['email', 'unique'],
            'tel' => [['tel'], 'string'],
            ['newPassword', 'string', 'min' => 8],
            ['password', 'string', 'min' => 8],
            ['rePassword', 'required', 'message' => 'Re Password must be equal to "New Password".'],
            [['firstname', 'lastname', 'email', 'password', 'confirmPassword'], 'required', 'on' => self::COZXY_REGIS],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Confirm Passwords don't match"],
            ['email', 'uniqueEmail', 'message' => 'This email address has already been taken.'
            ],
        ];
    }

    public function scenarios() {
        return [
            self::COZXY_REGIS => ['firstname', 'lastname', 'email', 'password', 'confirmPassword', 'acceptTerm'],
        ];
    }

    public function uniqueEmail($attribute, $email) {
        // throw new \yii\base\Exception($email);
        $user = static::findOne(['email' => Yii::$app->encrypter->encrypt($email)]);
        if (count($user) > 0)
            $this->addError($attribute, 'This email is already in use".');
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        /* if (!$this->validate()) {
          return null;
          } */

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

        return $user->save(FALSE) ? $user : null;
    }

}
