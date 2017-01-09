<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user".
*
    * @property string $userId
    * @property string $firstname
    * @property string $lastname
    * @property string $email
    * @property string $telephone
    * @property string $fax
    * @property string $password
    * @property string $cart
    * @property string $wishlist
    * @property integer $newsletter
    * @property string $ip
    * @property integer $status
    * @property integer $approved
    * @property string $token
    * @property integer $type
    * @property integer $isFirstLogin
    * @property string $description
    * @property string $logo
    * @property string $map
    * @property string $minimumOrder
    * @property string $referenceId
    * @property integer $collectedPoint
    * @property integer $collectedOrder
    * @property string $redirectURL
    * @property string $taxNumber
    * @property string $parentId
    * @property string $partnerCode
    * @property string $partnerDateTime
    * @property integer $partnerType
    * @property string $createDateTime
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
            [['firstname', 'lastname', 'email', 'telephone', 'fax', 'password', 'status', 'approved', 'type'], 'required'],
            [['cart', 'wishlist', 'description', 'logo', 'map'], 'string'],
            [['newsletter', 'status', 'approved', 'type', 'isFirstLogin', 'referenceId', 'collectedPoint', 'collectedOrder', 'parentId', 'partnerType'], 'integer'],
            [['minimumOrder'], 'number'],
            [['partnerDateTime', 'createDateTime'], 'safe'],
            [['firstname', 'lastname', 'telephone', 'fax'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 96],
            [['password'], 'string', 'max' => 40],
            [['ip'], 'string', 'max' => 15],
            [['token'], 'string', 'max' => 255],
            [['redirectURL'], 'string', 'max' => 200],
            [['taxNumber'], 'string', 'max' => 45],
            [['partnerCode'], 'string', 'max' => 100],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userId' => Yii::t('user', 'User ID'),
    'firstname' => Yii::t('user', 'Firstname'),
    'lastname' => Yii::t('user', 'Lastname'),
    'email' => Yii::t('user', 'Email'),
    'telephone' => Yii::t('user', 'Telephone'),
    'fax' => Yii::t('user', 'Fax'),
    'password' => Yii::t('user', 'Password'),
    'cart' => Yii::t('user', 'Cart'),
    'wishlist' => Yii::t('user', 'Wishlist'),
    'newsletter' => Yii::t('user', 'Newsletter'),
    'ip' => Yii::t('user', 'Ip'),
    'status' => Yii::t('user', 'Status'),
    'approved' => Yii::t('user', 'Approved'),
    'token' => Yii::t('user', 'Token'),
    'type' => Yii::t('user', 'Type'),
    'isFirstLogin' => Yii::t('user', 'Is First Login'),
    'description' => Yii::t('user', 'Description'),
    'logo' => Yii::t('user', 'Logo'),
    'map' => Yii::t('user', 'Map'),
    'minimumOrder' => Yii::t('user', 'Minimum Order'),
    'referenceId' => Yii::t('user', 'Reference ID'),
    'collectedPoint' => Yii::t('user', 'Collected Point'),
    'collectedOrder' => Yii::t('user', 'Collected Order'),
    'redirectURL' => Yii::t('user', 'Redirect Url'),
    'taxNumber' => Yii::t('user', 'Tax Number'),
    'parentId' => Yii::t('user', 'Parent ID'),
    'partnerCode' => Yii::t('user', 'Partner Code'),
    'partnerDateTime' => Yii::t('user', 'Partner Date Time'),
    'partnerType' => Yii::t('user', 'Partner Type'),
    'createDateTime' => Yii::t('user', 'Create Date Time'),
];
}
}
