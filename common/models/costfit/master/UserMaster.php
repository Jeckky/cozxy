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
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Address[] $addresses
            * @property Order[] $orders
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
            [['type', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['username', 'firstname', 'password', 'lastname', 'email'], 'string', 'max' => 200],
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
    'status' => Yii::t('user', 'Status'),
    'createDateTime' => Yii::t('user', 'Create Date Time'),
    'updateDateTime' => Yii::t('user', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAddresses()
    {
    return $this->hasMany(AddressMaster::className(), ['userId' => 'userId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getOrders()
    {
    return $this->hasMany(OrderMaster::className(), ['userId' => 'userId']);
    }
}
