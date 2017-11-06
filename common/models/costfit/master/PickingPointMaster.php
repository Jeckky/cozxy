<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "picking_point".
*
    * @property integer $pickingId
    * @property string $title
    * @property string $code
    * @property string $description
    * @property string $countryId
    * @property string $provinceId
    * @property string $amphurId
    * @property integer $type
    * @property string $ip
    * @property string $macAddress
    * @property string $authCode
    * @property integer $status
    * @property string $longitude
    * @property string $latitude
    * @property string $mapImages
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $serialnumber
    * @property string $generalprofile_lockercode
    * @property string $generalprofile_lockername
    * @property string $masterkey
    * @property string $username_unlock
    * @property string $token
*/
class PickingPointMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'picking_point';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title', 'code', 'provinceId', 'amphurId', 'createDateTime'], 'required'],
            [['provinceId', 'amphurId', 'type', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['token'], 'string'],
            [['title', 'countryId'], 'string', 'max' => 45],
            [['code'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 250],
            [['ip', 'macAddress', 'authCode'], 'string', 'max' => 100],
            [['longitude', 'latitude'], 'string', 'max' => 50],
            [['mapImages'], 'string', 'max' => 150],
            [['serialnumber', 'generalprofile_lockercode', 'generalprofile_lockername', 'masterkey', 'username_unlock'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pickingId' => Yii::t('picking_point', 'Picking ID'),
    'title' => Yii::t('picking_point', 'Title'),
    'code' => Yii::t('picking_point', 'Code'),
    'description' => Yii::t('picking_point', 'Description'),
    'countryId' => Yii::t('picking_point', 'Country ID'),
    'provinceId' => Yii::t('picking_point', 'Province ID'),
    'amphurId' => Yii::t('picking_point', 'Amphur ID'),
    'type' => Yii::t('picking_point', 'Type'),
    'ip' => Yii::t('picking_point', 'Ip'),
    'macAddress' => Yii::t('picking_point', 'Mac Address'),
    'authCode' => Yii::t('picking_point', 'Auth Code'),
    'status' => Yii::t('picking_point', 'Status'),
    'longitude' => Yii::t('picking_point', 'Longitude'),
    'latitude' => Yii::t('picking_point', 'Latitude'),
    'mapImages' => Yii::t('picking_point', 'Map Images'),
    'createDateTime' => Yii::t('picking_point', 'Create Date Time'),
    'updateDateTime' => Yii::t('picking_point', 'Update Date Time'),
    'serialnumber' => Yii::t('picking_point', 'Serialnumber'),
    'generalprofile_lockercode' => Yii::t('picking_point', 'Generalprofile Lockercode'),
    'generalprofile_lockername' => Yii::t('picking_point', 'Generalprofile Lockername'),
    'masterkey' => Yii::t('picking_point', 'Masterkey'),
    'username_unlock' => Yii::t('picking_point', 'Username Unlock'),
    'token' => Yii::t('picking_point', 'Token'),
];
}
}
