<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CategoryBrandPromotionMaster;

/**
 * This is the model class for table "category_brand_promotion".
 *
 * @property string $categoryBrandId
 * @property integer $categoryId
 * @property integer $brandId
 * @property integer $promotionId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class CategoryBrandPromotion extends \common\models\costfit\master\CategoryBrandPromotionMaster {

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

    public static function discountIems($orderId, $promotionId) {//หา items ใน orderItem ที่ Code นี้ลดได้
        $productId = '';
        $pArray = [];
        $promotion = CategoryBrandPromotion::find()->where("promotionId=$promotionId")->all();
        if (isset($promotion) && count($promotion) > 0) {
            foreach ($promotion as $p):
                if ($p->brandId != null) {
                    $products = OrderItem::find()
                            ->JOIN('LEFT JOIN', 'product p', 'p.productId=order_item.productId')
                            ->JOIN('LEFT JOIN', 'category c', 'c.categoryId=p.categoryId')
                            ->where("(c.categoryId=$p->categoryId or c.parentId=$p->categoryId) and p.brandId=$p->brandId and order_item.orderId=$orderId")//
                            ->all();
                } else {
                    $products = OrderItem::find()
                            ->JOIN('LEFT JOIN', 'product p', 'p.productId=order_item.productId')
                            ->JOIN('LEFT JOIN', 'category c', 'c.categoryId=p.categoryId')
                            ->where("c.categoryId=$p->categoryId or c.parentId=$p->categoryId and order_item.orderId=$orderId")
                            ->all();
                }
                if (isset($products) && count($products) > 0) {
                    foreach ($products as $product):
                        $pArray[$product->productId] = $product->productId;
                    endforeach;
                }
            endforeach;
            if (count($pArray) > 0) {
                $productId = implode(",", $pArray);
            }
        } else { // ถ้าไม่มีแสดงว่า ลดทุก Product
            $orderItems = OrderItem::find()->where("orderId=$orderId")->all();
            if (isset($orderItems) && count($orderItems) > 0) {
                foreach ($orderItems as $item):
                    $pArray[$item->productId] = $item->productId;
                endforeach;
                if (count($pArray) > 0) {
                    $productId = implode(",", $pArray);
                }
            }
        }
        return $productId;
    }

}
