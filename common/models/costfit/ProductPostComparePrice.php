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

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

}
