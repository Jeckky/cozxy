<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPriceCurrency as ProductPriceCurrencyModel;
use \common\models\costfit\query\ProductPriceCurrencyQuery;
/**
* This is the model class for table "product_price_currency".
*
* @property string $productPriceCurrencyId
* @property integer $status
* @property string $createDateTime
* @property string $currencyId
* @property string $price
* @property string $productId
*
* @property Product $product
*/

class ProductPriceCurrency extends ProductPriceCurrencyModel
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['status'], 'integer'],
        ]);
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    /**
    * @inheritdoc
    * @return \common\models\costfit\query\ProductPriceCurrencyQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new ProductPriceCurrencyQuery(get_called_class());
    }

    public function getCurrency()
    {
        return $this->hasOne(\common\models\worlddb\Currency::className(), ['currencyId' => 'currencyId']);
    }
}
