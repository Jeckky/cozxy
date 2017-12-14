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

    public static function isOverUse($promotionId) {
        $promotion = Promotion::find()->where("promotionId=" . $promotionId)->one();
        if (isset($promotion)) {
            if ($promotion->maximum == 0 || $promotion->maximum == null) { //ถ้าไม่ได้กำหนด หรือ กำหนดเป็น 0 = no limit
                return 0;
            } else {
                $totalUse = count(Order::find()->where("couponId=" . $promotionId)->all());
                if ($totalUse >= $promotion->maximum) {//เคยใช้ใน Order >= จำนวนสูงสุดที่ตั้งไว้
                    return 1;
                } else {
                    return 0;
                }
            }
        } else {
            return 0;
        }
    }

    public static function isOverUsePerPerson($promotionId) {
        $promotion = Promotion::find()->where("promotionId=" . $promotionId)->one();
        if (isset($promotion)) {
            if ($promotion->perUser == 0 || $promotion->perUser == null) { //ถ้าไม่ได้กำหนด หรือ กำหนดเป็น 0 = no limit
                return 0;
            } else {
                $totalUse = count(Order::find()->where("couponId=" . $promotionId . " and userId=" . \Yii::$app->user->id)->all());
                if ($totalUse >= $promotion->perUser) {//ถ้า user คนนี้เคยใช้ code นี้ไปแล้ว
                    return 1;
                } else {
                    return 0;
                }
            }
        } else {
            return 0;
        }
    }

    public static function isOverUsePerOrder($orderId) {//1 order ใช้ได้แค่ 1 promocode
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (isset($order)) {
            if ($order->couponId != null || $order->couponId != '') {
                return 1; //มีการใช้ Promotion ไปแล้ว
            } else {
                return 0;
            }
        }
    }

}
