<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_price_suppliers".
*
    * @property string $productPriceId
    * @property string $productSuppId
    * @property integer $quantity
    * @property string $price
    * @property integer $discountType
    * @property integer $discountValue
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductPriceSuppliersMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_price_suppliers';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productSuppId', 'price', 'createDateTime'], 'required'],
            [['productSuppId', 'quantity', 'discountType', 'discountValue', 'status'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productPriceId' => Yii::t('product_price_suppliers', 'Product Price ID'),
    'productSuppId' => Yii::t('product_price_suppliers', 'Product Supp ID'),
    'quantity' => Yii::t('product_price_suppliers', 'Quantity'),
    'price' => Yii::t('product_price_suppliers', 'Price'),
    'discountType' => Yii::t('product_price_suppliers', 'Discount Type'),
    'discountValue' => Yii::t('product_price_suppliers', 'Discount Value'),
    'description' => Yii::t('product_price_suppliers', 'Description'),
    'status' => Yii::t('product_price_suppliers', 'Status'),
    'createDateTime' => Yii::t('product_price_suppliers', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_price_suppliers', 'Update Date Time'),
];
}
}
