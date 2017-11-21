<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class MyAccountForm extends Model {

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
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Confirm Passwords don't match"],
        ];
    }

    public function scenarios() {
        return [
            self::COZXY_REGIS => ['firstname', 'lastname', 'email', 'password', 'confirmPassword', 'gender', 'dd', 'mm', 'yyyy'],
            self::COZXY_BOOTH_REGIS => ['firstname', 'lastname', 'tel', 'email', 'password', 'confirmPassword'],
        ];
    }

}
