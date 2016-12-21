<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "address".
*
    * @property string $addressId
    * @property string $userId
    * @property string $firstname
    * @property string $lastname
    * @property string $company
    * @property string $tax
    * @property string $address
    * @property string $countryId
    * @property string $provinceId
    * @property string $amphurId
    * @property string $districtId
    * @property string $zipcode
    * @property string $tel
    * @property integer $type
    * @property integer $isDefault
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $longitude
    * @property string $latitude
    * @property string $email
    * @property string $fax
*/
class AddressMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'address';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'createDateTime'], 'required'],
            [['userId', 'provinceId', 'amphurId', 'districtId', 'type', 'isDefault', 'status'], 'integer'],
            [['address'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['firstname', 'lastname', 'company'], 'string', 'max' => 200],
            [['tax', 'tel', 'fax'], 'string', 'max' => 45],
            [['countryId'], 'string', 'max' => 3],
            [['zipcode'], 'string', 'max' => 10],
            [['longitude', 'latitude'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 100],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'addressId' => Yii::t('address', 'Address ID'),
    'userId' => Yii::t('address', 'User ID'),
    'firstname' => Yii::t('address', 'Firstname'),
    'lastname' => Yii::t('address', 'Lastname'),
    'company' => Yii::t('address', 'Company'),
    'tax' => Yii::t('address', 'Tax'),
    'address' => Yii::t('address', 'Address'),
    'countryId' => Yii::t('address', 'Country ID'),
    'provinceId' => Yii::t('address', 'Province ID'),
    'amphurId' => Yii::t('address', 'Amphur ID'),
    'districtId' => Yii::t('address', 'District ID'),
    'zipcode' => Yii::t('address', 'Zipcode'),
    'tel' => Yii::t('address', 'Tel'),
    'type' => Yii::t('address', 'Type'),
    'isDefault' => Yii::t('address', 'Is Default'),
    'status' => Yii::t('address', 'Status'),
    'createDateTime' => Yii::t('address', 'Create Date Time'),
    'updateDateTime' => Yii::t('address', 'Update Date Time'),
    'longitude' => Yii::t('address', 'Longitude'),
    'latitude' => Yii::t('address', 'Latitude'),
    'email' => Yii::t('address', 'Email'),
    'fax' => Yii::t('address', 'Fax'),
];
}
}
