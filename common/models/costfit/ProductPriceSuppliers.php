<?php

namespace common\models\costfit;

use Yii;
use yii\data\ActiveDataProvider;
use \common\models\costfit\master\ProductPriceSuppliersMaster;

/**
 * This is the model class for table "product_price_suppliers".
 *
 * @property string $productPriceId
 * @property string $productId
 * @property string $quantity
 * @property string $price
 * @property integer $discountType
 * @property string $discountValue
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductPriceSuppliers extends \common\models\costfit\master\ProductPriceSuppliersMaster {

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
        return array_merge(parent::attributeLabels(), [
            'quantity' => 'จำนวน',
            'price' => 'ราคา',
            'discountType' => 'ประเภทส่วนลด',
            'discountValue' => 'ราคาส่วนลด',
            'description' => 'รายละเอียด'
        ]);
    }

    static public function getDiscountTypeArray() {
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

    public static function rankingPrice() {
        $rankingPrice = new ActiveDataProvider([
            'query' => ProductPriceSuppliers::find()
                    ->groupBy('price')
                    ->where('status = 1')
                    ->orderBy('price asc')
        ]);
        return $rankingPrice;
    }

}
