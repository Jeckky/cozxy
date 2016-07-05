<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductMaster;

/**
 * This is the model class for table "product".
 *
 * @property string $productId
 * @property string $userId
 * @property string $productGroupId
 * @property string $categoryId
 * @property string $code
 * @property string $title
 * @property string $description
 * @property string $width
 * @property string $height
 * @property string $depth
 * @property string $weight
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property ProductGroup $productGroup
 * @property Category $category
 * @property User $user
 * @property ProductPrice[] $productPrices
 * @property ProductPromotion[] $productPromotions
 * @property StoreProduct[] $storeProducts
 * @property StoreProductOrderItem[] $storeProductOrderItems
 */
class Product extends \common\models\costfit\master\ProductMaster
{

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

    public function getProductOnePrice()
    {
        return $this->hasOne(ProductPrice::className(), ['productId' => 'productId'])->andWhere('quantity = 1');
    }

    public function calProductPrice($productId, $quantity, $returnArray = 0)
    {
        $product = Product::find()->where("productId = $productId")->one();
        $productPrice = ProductPrice::find()->where("productId = $productId AND quantity = $quantity")->one();

        if (!$returnArray) {
            if (isset($productPrice)) {
                return $productPrice->price;
            } else {
                return $product->price;
            }
        } else {
            $res = [];
            if (isset($productPrice)) {
                $price = $productPrice->price;
                $res["discountType"] = isset($productPrice->discountType) ? $productPrice->discountType : NULL;
                $res["discountValue"] = isset($productPrice->discountValue) ? $productPrice->discountValue : NULL;
                $res["price"] = $price;
            } else {
                $price = $product->price;
            }
            $res["price"] = $price;
            $res["quantity"] = $quantity;


            return $res;
        }
    }

}
