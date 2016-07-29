<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductShippingPriceMaster;

/**
 * This is the model class for table "product_shipping_price".
 *
 * @property integer $producetShippingPriceId
 * @property integer $productId
 * @property integer $shippingTypeId
 * @property string $discount
 * @property string $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductShippingPrice extends \common\models\costfit\master\ProductShippingPriceMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'shippingTypeId' => 'Shipping Type',
        ]);
    }

    public function getProduct() {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    public function getShippingType() {
        return $this->hasOne(ShippingType::className(), ['shippingTypeId' => 'shippingTypeId']);
    }

}
