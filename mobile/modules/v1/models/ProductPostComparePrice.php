<?php

namespace mobile\modules\v1\models;

use common\models\costfit\CurrencyInfo;
use Yii;
use \common\models\costfit\ProductPostComparePrice as ProductPostComparePriceModel;

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
class ProductPostComparePrice extends ProductPostComparePriceModel
{



}
