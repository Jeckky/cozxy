<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "po_item".
*
    * @property string $poItemId
    * @property string $poId
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
class PoItemMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'po_item';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['poId', 'productId', 'shippingFromType', 'createDateTime'], 'required'],
            [['poId', 'storeId', 'productId', 'productSuppId', 'quantity', 'shippingFromType', 'importQuantity', 'orderItemId', 'status'], 'integer'],
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
    'poItemId' => Yii::t('po_item', 'Po Item ID'),
    'poId' => Yii::t('po_item', 'Po ID'),
    'storeId' => Yii::t('po_item', 'Store ID'),
    'productId' => Yii::t('po_item', 'Product ID'),
    'productSuppId' => Yii::t('po_item', 'Product Supp ID'),
    'paletNo' => Yii::t('po_item', 'Palet No'),
    'quantity' => Yii::t('po_item', 'Quantity'),
    'price' => Yii::t('po_item', 'Price'),
    'marginPercent' => Yii::t('po_item', 'Margin Percent'),
    'marginValue' => Yii::t('po_item', 'Margin Value'),
    'marginPrice' => Yii::t('po_item', 'Margin Price'),
    'total' => Yii::t('po_item', 'Total'),
    'shippingFromType' => Yii::t('po_item', 'Shipping From Type'),
    'importQuantity' => Yii::t('po_item', 'Import Quantity'),
    'remark' => Yii::t('po_item', 'Remark'),
    'orderItemId' => Yii::t('po_item', 'Order Item ID'),
    'status' => Yii::t('po_item', 'Status'),
    'createDateTime' => Yii::t('po_item', 'Create Date Time'),
    'updateDateTime' => Yii::t('po_item', 'Update Date Time'),
];
}
}
