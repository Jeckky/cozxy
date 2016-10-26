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
    * @property string $paletNo
    * @property string $quantity
    * @property string $price
    * @property string $total
    * @property integer $shippingFromType
    * @property string $importQuantity
    * @property string $remark
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
            [['storeProductGroupId', 'productId', 'shippingFromType', 'createDateTime'], 'required'],
            [['storeProductGroupId', 'storeId', 'productId', 'quantity', 'shippingFromType', 'importQuantity', 'status'], 'integer'],
            [['paletNo', 'price', 'total'], 'number'],
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
    'paletNo' => Yii::t('store_product', 'Palet No'),
    'quantity' => Yii::t('store_product', 'Quantity'),
    'price' => Yii::t('store_product', 'Price'),
    'total' => Yii::t('store_product', 'Total'),
    'shippingFromType' => Yii::t('store_product', 'Shipping From Type'),
    'importQuantity' => Yii::t('store_product', 'Import Quantity'),
    'remark' => Yii::t('store_product', 'Remark'),
    'status' => Yii::t('store_product', 'Status'),
    'createDateTime' => Yii::t('store_product', 'Create Date Time'),
    'updateDateTime' => Yii::t('store_product', 'Update Date Time'),
];
}
}
