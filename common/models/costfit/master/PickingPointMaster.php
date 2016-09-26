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
    * @property integer $status
    * @property integer $type
    * @property string $createDateTime
    * @property string $updateDateTime
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
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'description', 'countryId'], 'string', 'max' => 45],
            [['code'], 'string', 'max' => 30],
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
    'createDateTime' => Yii::t('picking_point', 'Create Date Time'),
    'updateDateTime' => Yii::t('picking_point', 'Update Date Time'),
];
}
}
