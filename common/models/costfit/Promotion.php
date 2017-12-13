<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PromotionMaster;

/**
 * This is the model class for table "promotion".
 *
 * @property string $promotionId
 * @property string $partnerTypeId
 * @property string $title
 * @property string $description
 * @property string $creatorId
 * @property string $startDateTime
 * @property string $endDateTime
 * @property string $percent
 * @property string $value
 * @property string $accumulation
 * @property integer $type
 * @property string $image
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Promotion extends \common\models\costfit\master\PromotionMaster {

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
        return array_merge(parent::attributeLabels(), []);
    }

    public static function brandPromotion($brandId, $promotionId) {
        if (isset($promotionId) && $promotionId != '') {
            $brand = PromotionBrand::find()->where("brandId=" . $brandId . " and promotionId=" . $promotionId)->one();
            if (isset($brand)) {
                return 1;
            }
        } else {
            return 0;
        }
    }

    public static function categoryPromotion($categoryId, $promotionId) {
        if (isset($promotionId) && $promotionId != '') {
            $brand = PromotionCategory::find()->where("categoryId=" . $categoryId . " and promotionId=" . $promotionId)->one();
            if (isset($brand)) {
                return 1;
            }
        } else {
            return 0;
        }
    }

}
