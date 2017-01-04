<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_items".
*
    * @property string $orderItemsId
    * @property string $orderId
    * @property string $productId
    * @property string $title
    * @property string $price
    * @property string $quantity
    * @property string $total
    * @property string $groupName
    * @property string $area
    * @property string $productOptionId
    * @property string $styleId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class OrderItemsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_items';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderId', 'title', 'price', 'quantity', 'total', 'createDateTime'], 'required'],
            [['orderId', 'productId', 'quantity', 'productOptionId', 'styleId', 'status'], 'integer'],
            [['price', 'total', 'area'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'groupName'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderItemsId' => Yii::t('order_items', 'Order Items ID'),
    'orderId' => Yii::t('order_items', 'Order ID'),
    'productId' => Yii::t('order_items', 'Product ID'),
    'title' => Yii::t('order_items', 'Title'),
    'price' => Yii::t('order_items', 'Price'),
    'quantity' => Yii::t('order_items', 'Quantity'),
    'total' => Yii::t('order_items', 'Total'),
    'groupName' => Yii::t('order_items', 'Group Name'),
    'area' => Yii::t('order_items', 'Area'),
    'productOptionId' => Yii::t('order_items', 'Product Option ID'),
    'styleId' => Yii::t('order_items', 'Style ID'),
    'status' => Yii::t('order_items', 'Status'),
    'createDateTime' => Yii::t('order_items', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_items', 'Update Date Time'),
];
}
}
