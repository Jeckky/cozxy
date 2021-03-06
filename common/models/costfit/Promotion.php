<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PromotionMaster;
use yii\data\ActiveDataProvider;

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
            $brand = CategoryBrandPromotion::find()->where("brandId=" . $brandId . " and promotionId=" . $promotionId)->one();
            if (isset($brand)) {
                return 1;
            }
        } else {
            return 0;
        }
    }

    public static function categoryPromotion($categoryId, $promotionId) {
        if (isset($promotionId) && $promotionId != '') {
            $category = CategoryBrandPromotion::find()->where("categoryId=" . $categoryId . " and promotionId=" . $promotionId)->one();
            if (isset($category)) {
                return 1;
            }
        } else {
            return 0;
        }
    }

    public static function categoryToBrandPromotion($categoryId) {
        $brandId = "";
        $brand = null;
        $allCategoryId = '';
        $level2 = '';
        $level4 = '';
        //throw new \yii\base\Exception($categoryId);
        if (isset($categoryId) && $categoryId != '') {
            $allCategory = Category::find()->where("categoryId=$categoryId or parentId=$categoryId")
                    ->orderBy("title")
                    ->all();
            if (isset($allCategory) && count($allCategory) > 0) {
                foreach ($allCategory as $category):
                    $subCategory = Category::find()->where("parentId=$category->categoryId and level=4 and status=1")
                            ->orderBy("title")
                            ->all();
                    if (isset($subCategory) && count($subCategory) > 0) {

                        foreach ($subCategory as $sub):
                            $level4 .= $sub->categoryId . ",";
                        endforeach;
                    }
                    $level2 .= $category->categoryId . ",";
                endforeach;

                $allCategoryId = self::category($level2, $level4);
                $products = Product::find()->where("categoryId in($allCategoryId)")
                        ->groupBy("brandId")
                        ->all();
                if (isset($products) && count($products) > 0) {
                    foreach ($products as $product):
                        if ($product->brandId != null && $product->brandId != '') {
                            $brandId .= $product->brandId . ",";
                        }
                    endforeach;
                }
            }
            if ($brandId != "") {
                $brandId = substr($brandId, 0, -1);
                $brand = Brand::find()->where("brandId in ($brandId)")->all();
            }
        }
        return $brand;
    }

    public static function category($level2, $level4) {
        $allCate = '';
        if ($level2 != '' && $level4 != '') {
            $level2 = substr($level2, 0, -1);
            $level4 = substr($level4, 0, -1);
            $allCate = $level2 . "," . $level4;
        } else if ($level2 != '' && $level4 == '') {
            $allCate = substr($level2, 0, -1);
        } else if ($level2 == '' && $level4 != '') {
            $allCate = substr($level4, 0, -1);
        }
        return $allCate;
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
                if (isset(\Yii::$app->user->id)) {
                    $totalUse = count(Order::find()->where("couponId=" . $promotionId . " and userId=" . \Yii::$app->user->id)->all());
                    if ($totalUse >= $promotion->perUser) {//ถ้า user คนนี้เคยใช้ code นี้ไปแล้ว
                        return 1;
                    } else {
                        return 0;
                    }
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

    public static function isExpired($today, $endDate) {

        if ($endDate == NULL) {
            return 0;
        } else {
            if ($today > $endDate) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    public static function variablePromotion($orderId, $couponId) {
        //throw new \yii\base\Exception($couponId);
        $order = Order::find()->where("orderId=$orderId")->one();
        if ($order->couponId == null || $order->couponId == '') {
            return 1;
        } else {
            if ($couponId == null) {
                return 1;
            } else {
                $checkVarible = Promotion::isOverUsePerPerson($couponId);
                if ($checkVarible) {
                    return 0; //ไช้ไม่ได้
                } else {
                    return 1;
                }
            }
        }
    }

    public static function pomotionsShowAll($n = null, $categoryId = null) {

        $pomotions = self::find();
        return new ActiveDataProvider([
            'query' => $pomotions,
            'pagination' => [
                'pageSize' => isset($n) ? $n : 12,
            ]
        ]);
    }

}
