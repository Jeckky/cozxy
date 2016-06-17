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
 * @property Order $order
 * @property StoreProduct $storeProduct
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
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'productId']],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['orderId' => 'orderId']],
            [['storeProductId'], 'exist', 'skipOnError' => true, 'targetClass' => StoreProduct::className(), 'targetAttribute' => ['storeProductId' => 'storeProductId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'storeProductOrderItemId' => 'Store Product Order Item ID',
            'orderId' => 'Order ID',
            'productId' => 'Product ID',
            'storeProductId' => 'Store Product ID',
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
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['orderId' => 'orderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProduct()
    {
        return $this->hasOne(StoreProduct::className(), ['storeProductId' => 'storeProductId']);
    }
}
