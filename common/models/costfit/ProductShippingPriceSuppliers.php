<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductShippingPriceSuppliersMaster;

/**
 * This is the model class for table "product_shipping_price_suppliers".
 *
 * @property string $productShippingPriceId
 * @property string $productId
 * @property string $shippingTypeId
 * @property string $date
 * @property string $discount
 * @property string $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductShippingPriceSuppliers extends \common\models\costfit\master\ProductShippingPriceSuppliersMaster {

    const DISCOUNT_TYPE_CASH = 1;
    const DISCOUNT_TYPE_PERCENT = 2;

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
            'shippingTypeId' => 'ประเภทวันจัดส่งสินค้า',
            'discount' => 'ราคาส่วนลด',
            'type' => 'ประเภทส่วนลด',
        ]);
    }

    public function getDiscountTypeArray() {
        return [
            self::DISCOUNT_TYPE_CASH => "CASH",
            self::DISCOUNT_TYPE_PERCENT => "PERCENT",
        ];
    }

    public function getDiscountTypeText($type) {
        $res = $this->getDiscountTypeArray();
        if (isset($res[$type])) {
            return $res[$type];
        } else {
            return NULL;
        }
    }

    public function getShippingType() {
        return $this->hasOne(\common\models\costfit\ShippingType::className(), ['shippingTypeId' => 'shippingTypeId']);
    }

    public function getProductsupp() {
        return $this->hasOne(ProductSuppliers::className(), ['productSuppId' => 'productSuppId']);
    }

}
