<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_item".
*
    * @property string $orderItemId
    * @property string $orderId
    * @property string $productId
    * @property string $productGroupId
    * @property string $brandId
    * @property string $categoryId
    * @property string $quantity
    * @property string $price
    * @property string $total
    * @property integer $sendDate
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Order $order
            * @property Product $product
    */
class OrderItemMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_item';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderId', 'productId', 'quantity', 'price', 'createDateTime'], 'required'],
            [['orderId', 'productId', 'productGroupId', 'brandId', 'categoryId', 'sendDate', 'status'], 'integer'],
            [['quantity', 'price', 'total'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderMaster::className(), 'targetAttribute' => ['orderId' => 'orderId']],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductMaster::className(), 'targetAttribute' => ['productId' => 'productId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderItemId' => Yii::t('order_item', 'Order Item ID'),
    'orderId' => Yii::t('order_item', 'Order ID'),
    'productId' => Yii::t('order_item', 'Product ID'),
    'productGroupId' => Yii::t('order_item', 'Product Group ID'),
    'brandId' => Yii::t('order_item', 'Brand ID'),
    'categoryId' => Yii::t('order_item', 'Category ID'),
    'quantity' => Yii::t('order_item', 'Quantity'),
    'price' => Yii::t('order_item', 'Price'),
    'total' => Yii::t('order_item', 'Total'),
    'sendDate' => Yii::t('order_item', 'Send Date'),
    'status' => Yii::t('order_item', 'Status'),
    'createDateTime' => Yii::t('order_item', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_item', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getOrder()
    {
    return $this->hasOne(OrderMaster::className(), ['orderId' => 'orderId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProduct()
    {
    return $this->hasOne(ProductMaster::className(), ['productId' => 'productId']);
    }
}
