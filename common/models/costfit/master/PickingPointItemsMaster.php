<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "picking_point_items".
*
    * @property string $pickingItemsId
    * @property integer $pickingId
    * @property string $name
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
            [['pickingId'], 'required'],
            [['pickingId'], 'integer'],
            [['name'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pickingItemsId' => Yii::t('picking_point_items', 'Picking Items ID'),
    'pickingId' => Yii::t('picking_point_items', 'Picking ID'),
    'name' => Yii::t('picking_point_items', 'Name'),
];
}
}
