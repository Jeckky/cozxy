<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "return_product".
*
    * @property string $returnProductId
    * @property integer $ticketId
    * @property integer $orderId
    * @property integer $orderItemId
    * @property integer $productSuppId
    * @property integer $quantity
    * @property integer $price
    * @property integer $totalPrice
    * @property integer $discount
    * @property integer $totalDiscount
    * @property integer $credit
    * @property integer $receiver
    * @property string $remark
    * @property integer $status
    * @property integer $createDateTime
    * @property integer $updateDateTime
*/
class ReturnProductMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'return_product';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['ticketId', 'orderId', 'orderItemId', 'productSuppId', 'quantity', 'price', 'totalPrice', 'discount', 'totalDiscount', 'credit', 'receiver', 'remark'], 'required'],
            [['ticketId', 'orderId', 'orderItemId', 'productSuppId', 'quantity', 'price', 'totalPrice', 'discount', 'totalDiscount', 'credit', 'receiver', 'status', 'createDateTime', 'updateDateTime'], 'integer'],
            [['remark'], 'string'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'returnProductId' => Yii::t('return_product', 'Return Product ID'),
    'ticketId' => Yii::t('return_product', 'Ticket ID'),
    'orderId' => Yii::t('return_product', 'Order ID'),
    'orderItemId' => Yii::t('return_product', 'Order Item ID'),
    'productSuppId' => Yii::t('return_product', 'Product Supp ID'),
    'quantity' => Yii::t('return_product', 'Quantity'),
    'price' => Yii::t('return_product', 'Price'),
    'totalPrice' => Yii::t('return_product', 'Total Price'),
    'discount' => Yii::t('return_product', 'Discount'),
    'totalDiscount' => Yii::t('return_product', 'Total Discount'),
    'credit' => Yii::t('return_product', 'Credit'),
    'receiver' => Yii::t('return_product', 'Receiver'),
    'remark' => Yii::t('return_product', 'Remark'),
    'status' => Yii::t('return_product', 'Status'),
    'createDateTime' => Yii::t('return_product', 'Create Date Time'),
    'updateDateTime' => Yii::t('return_product', 'Update Date Time'),
];
}
}
