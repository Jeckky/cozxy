<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PromotionBrandMaster;

/**
 * This is the model class for table "promotion_brand".
 *
 * @property string $promotionBrandId
 * @property integer $promotionId
 * @property integer $brandId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class PromotionBrand extends \common\models\costfit\master\PromotionBrandMaster {

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

    public static function brandItems($promotionId) {
        if (isset($promotionId) && $promotionId != '') {
            $promoBrand = PromotionBrand::find()->where("promotionId=" . $promotionId . " and status=1")->all();
            $brands = '';
            if (isset($promoBrand) && count($promoBrand) > 0) {
                foreach ($promoBrand as $brand):
                    $brands.=$brand->brandId . ',';
                endforeach;
                $brands = substr($brands, 0, -1);
                return $brands;
            } else {
                return 0; //ใช้ได้กับทุก Brand
            }
        } else {
            return 0;
        }
    }

    public static function productInBrand($orderId, $brandId, $isAll) {
        if ($isAll == 1) {
            $products = Product::find()
                    ->JOIN('LEFT JOIN', 'order_item oi', 'product.productId=oi.productId')
                    ->JOIN('LEFT JOIN', 'brand b', 'b.brandId=product.brandId')
                    ->where("oi.orderId=" . $orderId . " and b.brandId in($brandId)")
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
