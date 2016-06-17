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
 * @property StoreProductGroup $storeProductGroup
 * @property Store $store
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
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'productId']],
            [['storeProductGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProductGroup::className(), 'targetAttribute' => ['storeProductGroupId' => 'storeProductGroupId']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'storeId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'storeProductId' => 'Store Product ID',
            'storeProductGroupId' => 'Store Product Group ID',
            'storeId' => 'Store ID',
            'productId' => 'Product ID',
            'paletNo' => 'Palet No',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'total' => 'Total',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductGroup()
    {
        return $this->hasOne(StoreProductGroup::className(), ['storeProductGroupId' => 'storeProductGroupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['storeId' => 'storeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductOrderItems()
    {
        return $this->hasMany(StoreProductOrderItem::className(), ['storeProductId' => 'storeProductId']);
    }
}
