<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_item_packing".
*
    * @property integer $orderItemPackingId
    * @property integer $orderItemId
    * @property integer $pickingItemsId
    * @property string $bagNo
    * @property integer $quantity
    * @property integer $status
    * @property string $shipDate
    * @property string $remart
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class OrderItemPackingMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_item_packing';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderItemId', 'quantity'], 'required'],
            [['orderItemId', 'pickingItemsId', 'quantity', 'status'], 'integer'],
            [['shipDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['bagNo'], 'string', 'max' => 255],
            [['remart'], 'string', 'max' => 150],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderItemPackingId' => Yii::t('order_item_packing', 'Order Item Packing ID'),
    'orderItemId' => Yii::t('order_item_packing', 'Order Item ID'),
    'pickingItemsId' => Yii::t('order_item_packing', 'Picking Items ID'),
    'bagNo' => Yii::t('order_item_packing', 'Bag No'),
    'quantity' => Yii::t('order_item_packing', 'Quantity'),
    'status' => Yii::t('order_item_packing', 'Status'),
    'shipDate' => Yii::t('order_item_packing', 'Ship Date'),
    'remart' => Yii::t('order_item_packing', 'Remart'),
    'createDateTime' => Yii::t('order_item_packing', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_item_packing', 'Update Date Time'),
];
}
}
