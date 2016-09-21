<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "picking_point_items".
*
    * @property string $pickingItemsId
    * @property string $name
    * @property string $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PickingPointItemsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'picking_point_items';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['name'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name', 'status'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pickingItemsId' => Yii::t('picking_point_items', 'Picking Items ID'),
    'name' => Yii::t('picking_point_items', 'Name'),
    'status' => Yii::t('picking_point_items', 'Status'),
    'createDateTime' => Yii::t('picking_point_items', 'Create Date Time'),
    'updateDateTime' => Yii::t('picking_point_items', 'Update Date Time'),
];
}
}
