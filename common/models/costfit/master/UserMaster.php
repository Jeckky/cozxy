<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user".
*
    * @property string $userId
    * @property string $username
    * @property string $password_hash
    * @property string $firstname
    * @property string $password
    * @property string $lastname
    * @property string $email
    * @property string $token
    * @property integer $type
    * @property string $auth_key
    * @property string $auth_type
    * @property string $birthDate
    * @property integer $gender
    * @property string $tel
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['username', 'createDateTime'], 'required'],
            [['password_hash', 'token', 'auth_key'], 'string'],
            [['type', 'gender', 'status'], 'integer'],
            [['birthDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['username', 'firstname', 'password', 'lastname', 'email'], 'string', 'max' => 200],
            [['auth_type'], 'string', 'max' => 45],
            [['tel'], 'string', 'max' => 20],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userId' => Yii::t('user', 'User ID'),
    'username' => Yii::t('user', 'Username'),
    'password_hash' => Yii::t('user', 'Password Hash'),
    'firstname' => Yii::t('user', 'Firstname'),
    'password' => Yii::t('user', 'Password'),
    'lastname' => Yii::t('user', 'Lastname'),
    'email' => Yii::t('user', 'Email'),
    'token' => Yii::t('user', 'Token'),
    'type' => Yii::t('user', 'Type'),
    'auth_key' => Yii::t('user', 'Auth Key'),
    'auth_type' => Yii::t('user', 'Auth Type'),
    'birthDate' => Yii::t('user', 'Birth Date'),
    'gender' => Yii::t('user', 'Gender'),
    'tel' => Yii::t('user', 'Tel'),
    'status' => Yii::t('user', 'Status'),
    'createDateTime' => Yii::t('user', 'Create Date Time'),
    'updateDateTime' => Yii::t('user', 'Update Date Time'),
];
}
}
