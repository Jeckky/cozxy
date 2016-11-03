<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "supplier_product".
*
    * @property string $supplierProductId
    * @property string $supplierId
    * @property string $productId
    * @property integer $leaseTime
    * @property string $maxQuantity
    * @property string $price
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SupplierProductMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'supplier_product';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['supplierId', 'productId', 'leaseTime', 'price', 'createDateTime'], 'required'],
            [['supplierId', 'productId', 'leaseTime', 'status'], 'integer'],
            [['maxQuantity', 'price'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'supplierProductId' => Yii::t('supplier_product', 'Supplier Product ID'),
    'supplierId' => Yii::t('supplier_product', 'Supplier ID'),
    'productId' => Yii::t('supplier_product', 'Product ID'),
    'leaseTime' => Yii::t('supplier_product', 'Lease Time'),
    'maxQuantity' => Yii::t('supplier_product', 'Max Quantity'),
    'price' => Yii::t('supplier_product', 'Price'),
    'status' => Yii::t('supplier_product', 'Status'),
    'createDateTime' => Yii::t('supplier_product', 'Create Date Time'),
    'updateDateTime' => Yii::t('supplier_product', 'Update Date Time'),
];
}
}
