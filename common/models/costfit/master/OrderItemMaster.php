<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_item".
*
    * @property string $orderItemId
    * @property string $orderId
    * @property string $productId
    * @property string $productSuppId
    * @property string $productGroupId
    * @property string $brandId
    * @property string $categoryId
    * @property string $priceOnePiece
    * @property string $quantity
    * @property string $price
    * @property string $subTotal
    * @property string $discountValue
    * @property string $shippingDiscountValue
    * @property string $total
    * @property integer $sendDate
    * @property string $sendDateTime
    * @property integer $firstTimeSendDate
    * @property integer $pickerId
    * @property integer $color
    * @property string $bagNo
    * @property integer $supplierId
    * @property integer $status
    * @property string $receiveType
    * @property integer $pickingId
    * @property string $createDateTime
    * @property string $updateDateTime
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
            [['orderId', 'productId', 'priceOnePiece', 'quantity', 'price', 'createDateTime'], 'required'],
            [['orderId', 'productId', 'productSuppId', 'productGroupId', 'brandId', 'categoryId', 'sendDate', 'firstTimeSendDate', 'pickerId', 'color', 'supplierId', 'status', 'pickingId'], 'integer'],
            [['priceOnePiece', 'quantity', 'price', 'subTotal', 'discountValue', 'shippingDiscountValue', 'total'], 'number'],
            [['sendDateTime', 'createDateTime', 'updateDateTime'], 'safe'],
            [['bagNo'], 'string', 'max' => 20],
            [['receiveType'], 'string', 'max' => 45],
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
    'productSuppId' => Yii::t('order_item', 'Product Supp ID'),
    'productGroupId' => Yii::t('order_item', 'Product Group ID'),
    'brandId' => Yii::t('order_item', 'Brand ID'),
    'categoryId' => Yii::t('order_item', 'Category ID'),
    'priceOnePiece' => Yii::t('order_item', 'Price One Piece'),
    'quantity' => Yii::t('order_item', 'Quantity'),
    'price' => Yii::t('order_item', 'Price'),
    'subTotal' => Yii::t('order_item', 'Sub Total'),
    'discountValue' => Yii::t('order_item', 'Discount Value'),
    'shippingDiscountValue' => Yii::t('order_item', 'Shipping Discount Value'),
    'total' => Yii::t('order_item', 'Total'),
    'sendDate' => Yii::t('order_item', 'Send Date'),
    'sendDateTime' => Yii::t('order_item', 'Send Date Time'),
    'firstTimeSendDate' => Yii::t('order_item', 'First Time Send Date'),
    'pickerId' => Yii::t('order_item', 'Picker ID'),
    'color' => Yii::t('order_item', 'Color'),
    'bagNo' => Yii::t('order_item', 'Bag No'),
    'supplierId' => Yii::t('order_item', 'Supplier ID'),
    'status' => Yii::t('order_item', 'Status'),
    'receiveType' => Yii::t('order_item', 'Receive Type'),
    'pickingId' => Yii::t('order_item', 'Picking ID'),
    'createDateTime' => Yii::t('order_item', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_item', 'Update Date Time'),
];
}
}
