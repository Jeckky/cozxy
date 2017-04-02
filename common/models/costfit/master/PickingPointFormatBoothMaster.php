<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "picking_point_format_booth".
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
class PickingPointFormatBoothMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'picking_point_format_booth';
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
    'pickingItemsId' => Yii::t('picking_point_format_booth', 'Picking Items ID'),
    'code' => Yii::t('picking_point_format_booth', 'Code'),
    'name' => Yii::t('picking_point_format_booth', 'Name'),
    'portIndex' => Yii::t('picking_point_format_booth', 'Port Index'),
    'height' => Yii::t('picking_point_format_booth', 'Height'),
    'status' => Yii::t('picking_point_format_booth', 'Status'),
    'createDateTime' => Yii::t('picking_point_format_booth', 'Create Date Time'),
    'updateDateTime' => Yii::t('picking_point_format_booth', 'Update Date Time'),
];
}
}
