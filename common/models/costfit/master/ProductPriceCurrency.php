<?php

namespace common\models\costfit\master;

use Yii;

/**
 * This is the model class for table "product_price_currency".
 *
 * @property string $productPriceCurrencyId
 * @property int $status
 * @property string $createDateTime
 * @property string $currencyId
 * @property string $price
 * @property string $productId
 *
 * @property Product $product
 */
class ProductPriceCurrency extends \common\models\ModelMaster
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_price_currency';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createDateTime', 'currencyId', 'price', 'productId'], 'required'],
            [['createDateTime'], 'safe'],
            [['currencyId', 'productId'], 'integer'],
            [['price'], 'number'],
//            [['status'], 'string', 'max' => 5],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductMaster::className(), 'targetAttribute' => ['productId' => 'productId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productPriceCurrencyId' => 'Product Price Currency ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'currencyId' => 'Currency ID',
            'price' => 'Price',
            'productId' => 'Product ID',
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
