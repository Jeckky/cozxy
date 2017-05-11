<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "picking_point_format_lockers".
*
    * @property string $pickingItemsId
    * @property string $code
    * @property string $name
    * @property string $portIndex
    * @property integer $height
    * @property string $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PickingPointFormatLockersMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'picking_point_format_lockers';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['code', 'name'], 'required'],
            [['height'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['code', 'name', 'portIndex', 'status'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pickingItemsId' => Yii::t('picking_point_format_lockers', 'Picking Items ID'),
    'code' => Yii::t('picking_point_format_lockers', 'Code'),
    'name' => Yii::t('picking_point_format_lockers', 'Name'),
    'portIndex' => Yii::t('picking_point_format_lockers', 'Port Index'),
    'height' => Yii::t('picking_point_format_lockers', 'Height'),
    'status' => Yii::t('picking_point_format_lockers', 'Status'),
    'createDateTime' => Yii::t('picking_point_format_lockers', 'Create Date Time'),
    'updateDateTime' => Yii::t('picking_point_format_lockers', 'Update Date Time'),
];
}
}
