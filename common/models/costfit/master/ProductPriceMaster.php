<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_price".
*
    * @property string $productPriceId
    * @property string $productId
    * @property string $quantity
    * @property string $price
    * @property integer $discountType
    * @property string $discountValue
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductPriceMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_price';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productId', 'createDateTime'], 'required'],
            [['productId', 'discountType', 'status'], 'integer'],
            [['quantity', 'price', 'discountValue'], 'number'],
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
    'productPriceId' => Yii::t('product_price', 'Product Price ID'),
    'productId' => Yii::t('product_price', 'Product ID'),
    'quantity' => Yii::t('product_price', 'Quantity'),
    'price' => Yii::t('product_price', 'Price'),
    'discountType' => Yii::t('product_price', 'Discount Type'),
    'discountValue' => Yii::t('product_price', 'Discount Value'),
    'description' => Yii::t('product_price', 'Description'),
    'status' => Yii::t('product_price', 'Status'),
    'createDateTime' => Yii::t('product_price', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_price', 'Update Date Time'),
];
}
}
