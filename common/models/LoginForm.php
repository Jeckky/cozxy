<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model {

    public $email;
    //public $username;
    public $password;
    public $rememberMe = false;
    private $_user;

    //public $firstname;
    // public $lastname;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            ['email', 'email'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'rememberMe' => 'Remember me next time',
        );
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            if ($this->rememberMe == 1) {
                $remember = 3600 * 24 * 30 * 12;
            } else {
                $remember = 0;
            }

            $login = Yii::$app->user->login($this->getUser(), $remember); // 1 เดือน
            //return Yii::$app->user->login($this->getUser(), 3600 * 24 * 30);
            //echo $login;
            return $login;
        } else {
            return false;
        }
    }

    public function login2($user) {
        $user1 = User::findByUsername($user->email);
        return Yii::$app->user->login($user1, 3600 * 24 * 30);
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->email);
        }
        return $this->_user;
    }

}
