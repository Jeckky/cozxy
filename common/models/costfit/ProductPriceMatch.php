<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPriceMatchMaster;

/**
 * This is the model class for table "product_price_match".
 *
 * @property integer $productPriceMatchId
 * @property integer $productId
 * @property integer $discountPercent
 * @property integer $discountValue
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $productMatchId
 */
class ProductPriceMatch extends \common\models\costfit\master\ProductPriceMatchMaster
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getProductPriceMatchGroup()
    {
        return $this->hasOne(ProductPriceMatchGroup::className(), ['productPriceMatchGroupId' => 'productPriceMatchGroupId']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

}
