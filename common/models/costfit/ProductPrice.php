<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPriceMaster;

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

class ProductPrice extends \common\models\costfit\master\ProductPriceMaster{
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
}
