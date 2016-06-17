<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPromotionMaster;

/**
* This is the model class for table "product_promotion".
*
* @property string $productPromotionId
* @property string $productId
* @property string $statusDate
* @property string $endDate
* @property string $discount
* @property integer $discountType
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*
* @property Product $product
*/

class ProductPromotion extends \common\models\costfit\master\ProductPromotionMaster{
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
