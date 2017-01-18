<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "return_product".
*
    * @property string $returnProdctId
    * @property integer $orderId
    * @property integer $orderItemId
    * @property integer $productSuppId
    * @property integer $quantity
    * @property integer $price
    * @property integer $receiver
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
            [['orderId', 'orderItemId', 'productSuppId', 'quantity', 'price', 'receiver', 'status', 'createDateTime', 'updateDateTime'], 'integer'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'returnProdctId' => Yii::t('return_product', 'Return Prodct ID'),
    'orderId' => Yii::t('return_product', 'Order ID'),
    'orderItemId' => Yii::t('return_product', 'Order Item ID'),
    'productSuppId' => Yii::t('return_product', 'Product Supp ID'),
    'quantity' => Yii::t('return_product', 'Quantity'),
    'price' => Yii::t('return_product', 'Price'),
    'receiver' => Yii::t('return_product', 'Receiver'),
    'status' => Yii::t('return_product', 'Status'),
    'createDateTime' => Yii::t('return_product', 'Create Date Time'),
    'updateDateTime' => Yii::t('return_product', 'Update Date Time'),
];
}
}
