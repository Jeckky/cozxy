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
                $res["discountValueText"] = isset($productPrice->discountValue) ? number_format($productPrice->discountValue, 2) : NULL;
                $res["price"] = $price;
                $res["priceText"] = number_format($price, 2) . " ฿";
            } else {
                $price = $product->price;
                $res["discountType"] = isset($productPrice->discountType) ? $productPrice->discountType : NULL;
                $res["discountValue"] = isset($productPrice->discountValue) ? $productPrice->discountValue : NULL;
                $res["discountValueText"] = isset($productPrice->discountValue) ? number_format($productPrice->discountValue, 2) : NULL;
                $res["price"] = $price;
                $res["priceText"] = number_format($price, 2) . " ฿";
            }
            $res["price"] = $price;
            $res["quantity"] = $quantity;


            return $res;
        }
    }

    public static function findMaxQuantity($id, $checkInCart = 1)
    {
//        throw new \yii\base\Exception("productId =" . $id);
        $productPrice = ProductPrice::find()->select("MAX(quantity) as maxQuantity")->where("productId = $id")->one();
        if (isset($productPrice)) {
            if ($checkInCart) {
                $quantityInCart = Product::findQuantityInCart($id);
                return $productPrice->maxQuantity - $quantityInCart;
            } else {
                return $productPrice->maxQuantity;
            }
        } else {
            return 1;
        }
    }

    public static function findQuantityInCart($id)
    {
        $order = Order::findCartArray();
        $quantity = 0;
        foreach ($order["items"] as $item) {
            if ($item['productId'] == $id) {
                $quantity = $item['qty'];
                break;
            }
        }

        return $quantity;
    }

    public function getProductPrices()
    {
        return $this->hasMany(ProductPrice::className(), ['productId' => 'productId']);
    }

    public function getBestSellProduct()
    {
        //return $this->hasMany(ProductPrice::className(), ['productId' => 'productId']);
    }

    public function findOutProducts()
    {
        //return $this->hasMany(ProductPrice::className(), ['productId' => 'productId']);
    }

    public function findOnSellProducts()
    {
        //return $this->hasMany(ProductPrice::className(), ['productId' => 'productId']);
    }

    public function addProductShipping($id)
    {
        $productShippingPrice = new ProductShippingPrice();
        $productShippingPrice->productId = $id;
        $productShippingPrice->shippingTypeId = 1;
        $productShippingPrice->discount = 0;
        $productShippingPrice->type = 1;
        $productShippingPrice->createDateTime = new \yii\db\Expression('NOW()');
        $productShippingPrice->updateDateTime = new \yii\db\Expression('NOW()');
        $productShippingPrice->save(false);
        $productShippingPrice = new ProductShippingPrice();
        $productShippingPrice->productId = $id;
        $productShippingPrice->shippingTypeId = 2;
        $productShippingPrice->discount = 0;
        $productShippingPrice->type = 1;
        $productShippingPrice->createDateTime = new \yii\db\Expression('NOW()');
        $productShippingPrice->updateDateTime = new \yii\db\Expression('NOW()');
        $productShippingPrice->save(false);
        //throw new \yii\base\Exception('adfasdf');
    }

    public function getUnits()
    {
        return $this->hasOne(Unit::className(), ['unitId' => 'unit']);
    }

    public function getImages()
    {
        return $this->hasOne(ProductImage::className(), ['productId' => 'productId']);
    }

    public static function getShippingTypeId($productId)
    {
        $fastDate = 99;
        $productShippingDates = ProductShippingPrice::find()->where("productId =" . $productId)->all();
        foreach ($productShippingDates as $productShippingDate) {
            $shippingType = ShippingType::find()->where("shippingTypeId=" . $productShippingDate->shippingTypeId)->one();
            if (count($shippingType) > 0) {
                if ($shippingType->date < $fastDate) {
                    $fastDate = $shippingType->date;
                    $fastId = $productShippingDate->shippingTypeId;
                }
            } else {
                $fastDate = '';
                $fastId = '';
            }
        }
        return $fastId;
    }

}
