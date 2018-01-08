<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PromotionCategoryMaster;

/**
 * This is the model class for table "promotion_category".
 *
 * @property string $promotionCategoryId
 * @property integer $promotionId
 * @property integer $categoryId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class PromotionCategory extends \common\models\costfit\master\PromotionCategoryMaster {

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

    public static function categoryItems($promotionId) {
        if (isset($promotionId) && $promotionId != '') {
            $promoCate = PromotionCategory::find()->where("promotionId=" . $promotionId . " and status=1")->all();
            $category = '';
            if (isset($promoCate) && count($promoCate) > 0) {
                foreach ($promoCate as $cate):
                    $category.=$cate->categoryId . ',';
                endforeach;
                $category = substr($category, 0, -1);
                return $category;
            } else {
                return 0; //ใช้ได้กับทุก category
            }
        } else {
            return 0;
        }
    }

    public static function productInCate($orderId, $categoryId, $isAll) {
        if ($isAll == 1) {
            $products = Product::find()
                    ->JOIN('LEFT JOIN', 'order_item oi', 'product.productId=oi.productId')
                    ->JOIN('LEFT JOIN', 'category c', 'c.categoryId=product.categoryId')
                    ->where("oi.orderId=" . $orderId . " and (c.categoryId in($categoryId) or c.parentId in($categoryId))")
                    ->all();
        } else {
            $products = OrderItem::find()
                    ->where("orderId=$orderId")
                    ->all();
        }
        $productId = '';
        if (isset($products) && count($products) > 0) {
            foreach ($products as $product):
                $productId.=$product->productId . ",";
            endforeach;
            $productId = substr($productId, 0, -1);

            return $productId;
        } else {
            return '';
        }
    }

}
