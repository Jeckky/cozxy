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
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Product $product
            * @property Store $store
            * @property StoreProductGroup $storeProductGroup
            * @property StoreProductOrderItem[] $storeProductOrderItems
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
            [['storeProductGroupId', 'storeId', 'productId', 'createDateTime'], 'required'],
            [['storeProductGroupId', 'storeId', 'productId', 'status'], 'integer'],
            [['paletNo', 'price', 'total'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['quantity'], 'string', 'max' => 45],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductMaster::className(), 'targetAttribute' => ['productId' => 'productId']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => StoreMaster::className(), 'targetAttribute' => ['storeId' => 'storeId']],
            [['storeProductGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProductGroupMaster::className(), 'targetAttribute' => ['storeProductGroupId' => 'storeProductGroupId']],
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
    'status' => Yii::t('store_product', 'Status'),
    'createDateTime' => Yii::t('store_product', 'Create Date Time'),
    'updateDateTime' => Yii::t('store_product', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProduct()
    {
    return $this->hasOne(ProductMaster::className(), ['productId' => 'productId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getStore()
    {
    return $this->hasOne(StoreMaster::className(), ['storeId' => 'storeId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getStoreProductGroup()
    {
    return $this->hasOne(StoreProductGroupMaster::className(), ['storeProductGroupId' => 'storeProductGroupId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getStoreProductOrderItems()
    {
    return $this->hasMany(StoreProductOrderItemMaster::className(), ['storeProductId' => 'storeProductId']);
    }
}
