<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPostComparePriceMaster;

/**
 * This is the model class for table "product_post_compare_price".
 *
 * @property string $comparePriceId
 * @property string $productPostId
 * @property string $productId
 * @property string $productSelfId
 * @property string $shopName
 * @property string $price
 * @property string $country
 * @property string $currency
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductPostComparePrice extends \common\models\costfit\master\ProductPostComparePriceMaster {

    const Cozxy_Product_Post_Compare_Price = 'ComparePrice';

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
            ['shopName', 'required'],
            ['price', 'required'],
            ['country', 'required'],
            ['currency', 'required'],
            [['shopName', 'price', 'country', 'currency'], 'required', 'on' => self::Cozxy_Product_Post_Compare_Price],
        ]);
    }

    public function scenarios() {
        return [
            self::Cozxy_Product_Post_Compare_Price => ['shopName', 'price', 'country', 'currency'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
        ]);
    }

    public function attributes() {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), [
            'currency_code', 'ccy_name'
        ]);
    }

}
