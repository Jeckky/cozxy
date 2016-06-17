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
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property Product $product
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
            [['productId', 'discountType', 'createDateTime'], 'required'],
            [['productId', 'discountType', 'status'], 'integer'],
            [['quantity', 'price'], 'number'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'productId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productPriceId' => 'Product Price ID',
            'productId' => 'Product ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'discountType' => 'Discount Type',
            'description' => 'Description',
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
}
