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
            ['password', 'string', 'min' => 6],
            ['email', 'unique'], 'tel' => [['tel'], 'string'],
            ['newPassword', 'string', 'min' => 8],
            ['password', 'string', 'min' => 8],
            ['rePassword', 'required', 'message' => 'Re Password must be equal to "New Password".'],
            ['email', 'email'],
            [['firstname', 'lastname', 'email', 'password', 'confirmPassword'], 'required', 'on' => self::COZXY_REGIS],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Confirm Passwords don't match"],
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
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->username = $this->username;
        $user->gender = $this->gender;
        $user->birthDate = $this->birthDate;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }

}
