<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_shipping_price_suppliers".
*
    * @property integer $productShippingPriceId
    * @property integer $productSuppId
    * @property integer $shippingTypeId
    * @property integer $date
    * @property string $discount
    * @property string $type
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductShippingPriceSuppliersMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_shipping_price_suppliers';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productSuppId', 'shippingTypeId', 'type'], 'required'],
            [['productSuppId', 'shippingTypeId', 'date', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['discount', 'type'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productShippingPriceId' => Yii::t('product_shipping_price_suppliers', 'Product Shipping Price ID'),
    'productSuppId' => Yii::t('product_shipping_price_suppliers', 'Product Supp ID'),
    'shippingTypeId' => Yii::t('product_shipping_price_suppliers', 'Shipping Type ID'),
    'date' => Yii::t('product_shipping_price_suppliers', 'Date'),
    'discount' => Yii::t('product_shipping_price_suppliers', 'Discount'),
    'type' => Yii::t('product_shipping_price_suppliers', 'Type'),
    'status' => Yii::t('product_shipping_price_suppliers', 'Status'),
    'createDateTime' => Yii::t('product_shipping_price_suppliers', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_shipping_price_suppliers', 'Update Date Time'),
];
}
}
