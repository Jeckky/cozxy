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
class ProductPrice extends \common\models\costfit\master\ProductPriceMaster {

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
    public function attributes() {
        return array_merge(parent::attributes(), [
            'maxQuantity'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
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

    public function getSavePrice() {
        if ($this->discountType == 1) {
            return $this->discountValue;
        } else {
            $productPrice = ProductPrice::find()->where("quantity = 1 AND productId =" . $this->productId)->one();
            $price = ($productPrice->price * $this->quantity) - $this->price;
            return $price;
        }
    }

}
