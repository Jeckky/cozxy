<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_item_option".
*
    * @property string $orderItemOption
    * @property string $orderItemId
    * @property string $productOptionGroupId
    * @property string $productOptionId
    * @property string $value
    * @property string $percent
    * @property string $total
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class OrderItemOptionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_item_option';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderItemId', 'productOptionGroupId', 'productOptionId', 'createDateTime'], 'required'],
            [['orderItemId', 'productOptionGroupId', 'productOptionId', 'status'], 'integer'],
            [['value', 'percent', 'total'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderItemOption' => Yii::t('order_item_option', 'Order Item Option'),
    'orderItemId' => Yii::t('order_item_option', 'Order Item ID'),
    'productOptionGroupId' => Yii::t('order_item_option', 'Product Option Group ID'),
    'productOptionId' => Yii::t('order_item_option', 'Product Option ID'),
    'value' => Yii::t('order_item_option', 'Value'),
    'percent' => Yii::t('order_item_option', 'Percent'),
    'total' => Yii::t('order_item_option', 'Total'),
    'status' => Yii::t('order_item_option', 'Status'),
    'createDateTime' => Yii::t('order_item_option', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_item_option', 'Update Date Time'),
];
}
}
