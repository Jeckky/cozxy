<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "store_product_order_item".
*
    * @property string $storeProductOrderItemId
    * @property string $orderId
    * @property string $productId
    * @property string $storeProductId
    * @property string $quantity
    * @property string $price
    * @property string $total
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Product $product
            * @property StoreProduct $storeProduct
            * @property Order $order
    */
class StoreProductOrderItemMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'store_product_order_item';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderId', 'productId', 'createDateTime'], 'required'],
            [['orderId', 'productId', 'storeProductId', 'status'], 'integer'],
            [['price', 'total'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['quantity'], 'string', 'max' => 45],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductMaster::className(), 'targetAttribute' => ['productId' => 'productId']],
            [['storeProductId'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProductMaster::className(), 'targetAttribute' => ['storeProductId' => 'storeProductId']],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderMaster::className(), 'targetAttribute' => ['orderId' => 'orderId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'storeProductOrderItemId' => Yii::t('store_product_order_item', 'Store Product Order Item ID'),
    'orderId' => Yii::t('store_product_order_item', 'Order ID'),
    'productId' => Yii::t('store_product_order_item', 'Product ID'),
    'storeProductId' => Yii::t('store_product_order_item', 'Store Product ID'),
    'quantity' => Yii::t('store_product_order_item', 'Quantity'),
    'price' => Yii::t('store_product_order_item', 'Price'),
    'total' => Yii::t('store_product_order_item', 'Total'),
    'status' => Yii::t('store_product_order_item', 'Status'),
    'createDateTime' => Yii::t('store_product_order_item', 'Create Date Time'),
    'updateDateTime' => Yii::t('store_product_order_item', 'Update Date Time'),
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
    public function getStoreProduct()
    {
    return $this->hasOne(StoreProductMaster::className(), ['storeProductId' => 'storeProductId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getOrder()
    {
    return $this->hasOne(OrderMaster::className(), ['orderId' => 'orderId']);
    }
}
