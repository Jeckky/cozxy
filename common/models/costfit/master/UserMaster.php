<?php

namespace common\models\costfit\master;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $userId
 * @property string $username
 * @property string $hash_password
 * @property string $firstname
 * @property string $password
 * @property string $lastname
 * @property string $email
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property Address[] $addresses
 * @property Order[] $orders
 * @property Product[] $products
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
            [['username', 'firstname', 'lastname', 'createDateTime'], 'required'],
            [['hash_password'], 'string'],
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
            'userId' => 'User ID',
            'username' => 'Username',
            'hash_password' => 'Hash Password',
            'firstname' => 'Firstname',
            'password' => 'Password',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'type' => 'Type',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['userId' => 'userId']);
    }
}
