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
    * @property string $address_1
    * @property string $address_2
    * @property string $districtId
    * @property string $amphurId
    * @property string $provinceId
    * @property string $countryId
    * @property string $postcode
    * @property integer $type
    * @property double $latitude
    * @property double $longitude
    * @property string $taxNo
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
            [['userId', 'firstname', 'lastname', 'address_1', 'address_2', 'districtId', 'amphurId', 'provinceId', 'postcode', 'type'], 'required'],
            [['userId', 'districtId', 'amphurId', 'provinceId', 'countryId', 'type'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['firstname', 'lastname'], 'string', 'max' => 80],
            [['company'], 'string', 'max' => 200],
            [['address_1', 'address_2'], 'string', 'max' => 255],
            [['postcode'], 'string', 'max' => 10],
            [['taxNo'], 'string', 'max' => 128],
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
    'address_1' => Yii::t('address', 'Address 1'),
    'address_2' => Yii::t('address', 'Address 2'),
    'districtId' => Yii::t('address', 'District ID'),
    'amphurId' => Yii::t('address', 'Amphur ID'),
    'provinceId' => Yii::t('address', 'Province ID'),
    'countryId' => Yii::t('address', 'Country ID'),
    'postcode' => Yii::t('address', 'Postcode'),
    'type' => Yii::t('address', 'Type'),
    'latitude' => Yii::t('address', 'Latitude'),
    'longitude' => Yii::t('address', 'Longitude'),
    'taxNo' => Yii::t('address', 'Tax No'),
];
}
}
