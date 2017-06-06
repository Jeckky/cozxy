<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "store_product_arrange".
*
    * @property string $storeProductArrangeId
    * @property string $storeProductId
    * @property string $productId
    * @property string $productSuppId
    * @property string $slotId
    * @property string $quantity
    * @property integer $orderId
    * @property integer $parentId
    * @property integer $result
    * @property integer $pickerId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class StoreProductArrangeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'store_product_arrange';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['storeProductId', 'productId', 'productSuppId', 'slotId', 'quantity', 'createDateTime'], 'required'],
            [['storeProductId', 'productId', 'productSuppId', 'slotId', 'orderId', 'parentId', 'result', 'pickerId', 'status'], 'integer'],
            [['quantity'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'storeProductArrangeId' => Yii::t('store_product_arrange', 'Store Product Arrange ID'),
    'storeProductId' => Yii::t('store_product_arrange', 'Store Product ID'),
    'productId' => Yii::t('store_product_arrange', 'Product ID'),
    'productSuppId' => Yii::t('store_product_arrange', 'Product Supp ID'),
    'slotId' => Yii::t('store_product_arrange', 'Slot ID'),
    'quantity' => Yii::t('store_product_arrange', 'Quantity'),
    'orderId' => Yii::t('store_product_arrange', 'Order ID'),
    'parentId' => Yii::t('store_product_arrange', 'Parent ID'),
    'result' => Yii::t('store_product_arrange', 'Result'),
    'pickerId' => Yii::t('store_product_arrange', 'Picker ID'),
    'status' => Yii::t('store_product_arrange', 'Status'),
    'createDateTime' => Yii::t('store_product_arrange', 'Create Date Time'),
    'updateDateTime' => Yii::t('store_product_arrange', 'Update Date Time'),
];
}
}
