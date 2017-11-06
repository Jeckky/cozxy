<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_item_packing_items".
*
    * @property integer $remarkId
    * @property integer $pickingItemsId
    * @property integer $orderItemPackingId
    * @property string $desc
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $lastvisitDate
*/
class OrderItemPackingItemsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_item_packing_items';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['pickingItemsId', 'orderItemPackingId'], 'required'],
            [['pickingItemsId', 'orderItemPackingId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime', 'lastvisitDate'], 'safe'],
            [['desc'], 'string', 'max' => 250],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'remarkId' => Yii::t('order_item_packing_items', 'Remark ID'),
    'pickingItemsId' => Yii::t('order_item_packing_items', 'Picking Items ID'),
    'orderItemPackingId' => Yii::t('order_item_packing_items', 'Order Item Packing ID'),
    'desc' => Yii::t('order_item_packing_items', 'Desc'),
    'status' => Yii::t('order_item_packing_items', 'Status'),
    'createDateTime' => Yii::t('order_item_packing_items', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_item_packing_items', 'Update Date Time'),
    'lastvisitDate' => Yii::t('order_item_packing_items', 'Lastvisit Date'),
];
}
}
