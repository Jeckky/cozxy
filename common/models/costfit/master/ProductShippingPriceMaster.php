<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_shipping_price".
*
    * @property integer $productShippingPriceId
    * @property integer $productId
    * @property integer $shippingTypeId
    * @property integer $date
    * @property string $discount
    * @property string $type
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductShippingPriceMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_shipping_price';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productId', 'shippingTypeId', 'type'], 'required'],
            [['productId', 'shippingTypeId', 'date', 'status'], 'integer'],
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
    'productShippingPriceId' => Yii::t('product_shipping_price', 'Product Shipping Price ID'),
    'productId' => Yii::t('product_shipping_price', 'Product ID'),
    'shippingTypeId' => Yii::t('product_shipping_price', 'Shipping Type ID'),
    'date' => Yii::t('product_shipping_price', 'Date'),
    'discount' => Yii::t('product_shipping_price', 'Discount'),
    'type' => Yii::t('product_shipping_price', 'Type'),
    'status' => Yii::t('product_shipping_price', 'Status'),
    'createDateTime' => Yii::t('product_shipping_price', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_shipping_price', 'Update Date Time'),
];
}
}
