<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "store_product".
*
    * @property string $storeProductId
    * @property string $storeProductGroupId
    * @property string $storeId
    * @property string $productId
    * @property integer $productSuppId
    * @property string $paletNo
    * @property integer $quantity
    * @property string $price
    * @property string $marginPercent
    * @property string $marginValue
    * @property string $marginPrice
    * @property string $total
    * @property integer $shippingFromType
    * @property integer $importQuantity
    * @property string $remark
    * @property string $orderItemId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class StoreProductMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'store_product';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['storeProductGroupId', 'productId', 'createDateTime'], 'required'],
            [['storeProductGroupId', 'storeId', 'productId', 'productSuppId', 'quantity', 'shippingFromType', 'importQuantity', 'orderItemId', 'status'], 'integer'],
            [['paletNo', 'price', 'marginPercent', 'marginValue', 'marginPrice', 'total'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['remark'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'storeProductId' => Yii::t('store_product', 'Store Product ID'),
    'storeProductGroupId' => Yii::t('store_product', 'Store Product Group ID'),
    'storeId' => Yii::t('store_product', 'Store ID'),
    'productId' => Yii::t('store_product', 'Product ID'),
    'productSuppId' => Yii::t('store_product', 'Product Supp ID'),
    'paletNo' => Yii::t('store_product', 'Palet No'),
    'quantity' => Yii::t('store_product', 'Quantity'),
    'price' => Yii::t('store_product', 'Price'),
    'marginPercent' => Yii::t('store_product', 'Margin Percent'),
    'marginValue' => Yii::t('store_product', 'Margin Value'),
    'marginPrice' => Yii::t('store_product', 'Margin Price'),
    'total' => Yii::t('store_product', 'Total'),
    'shippingFromType' => Yii::t('store_product', 'Shipping From Type'),
    'importQuantity' => Yii::t('store_product', 'Import Quantity'),
    'remark' => Yii::t('store_product', 'Remark'),
    'orderItemId' => Yii::t('store_product', 'Order Item ID'),
    'status' => Yii::t('store_product', 'Status'),
    'createDateTime' => Yii::t('store_product', 'Create Date Time'),
    'updateDateTime' => Yii::t('store_product', 'Update Date Time'),
];
}
}
