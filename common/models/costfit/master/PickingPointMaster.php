<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "picking_point".
*
    * @property string $pickingId
    * @property string $title
    * @property string $code
    * @property string $description
    * @property string $countryId
    * @property string $provinceId
    * @property string $amphurId
    * @property integer $status
    * @property integer $type
    * @property string $ip
    * @property string $macAddress
    * @property string $authCode
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $lastvisitDate
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
            [['title', 'code', 'description', 'provinceId', 'amphurId', 'createDateTime'], 'required'],
            [['provinceId', 'amphurId', 'status', 'type'], 'integer'],
            [['createDateTime', 'updateDateTime', 'lastvisitDate'], 'safe'],
            [['title', 'description', 'countryId'], 'string', 'max' => 45],
            [['code'], 'string', 'max' => 30],
            [['ip', 'macAddress', 'authCode'], 'string', 'max' => 100],
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
    'status' => Yii::t('picking_point', 'Status'),
    'type' => Yii::t('picking_point', 'Type'),
    'ip' => Yii::t('picking_point', 'Ip'),
    'macAddress' => Yii::t('picking_point', 'Mac Address'),
    'authCode' => Yii::t('picking_point', 'Auth Code'),
    'createDateTime' => Yii::t('picking_point', 'Create Date Time'),
    'updateDateTime' => Yii::t('picking_point', 'Update Date Time'),
    'lastvisitDate' => Yii::t('picking_point', 'Lastvisit Date'),
];
}
}
