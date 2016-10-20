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
class Product extends \common\models\costfit\master\ProductMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
            [['storeProductId'], 'safe'],
        ]);
    }

    public function afterFind() {
        parent::afterFind();
        if (!$this->isNewRecord) {
            ProductView::saveProductView($this->productId);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public function attributes() {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), [
            'storeProductId', 'sumViews', 'importQuantity', 'storeProductId', 'storeProductGroupId'
        ]);
    }

    public function getProductOnePrice() {
        return $this->hasOne(ProductPrice::className(), ['productId' => 'productId'])->andWhere('quantity = 1');
    }

    public function calProductPrice($productId, $quantity, $returnArray = 0, $shippingStep = 1) {

        $product = Product::find()->where("productId = $productId")->one();
        $productPrice = ProductPrice::find()->where("productId = $productId AND quantity = $quantity")->one();
        $shippingDisCount = ProductShippingPrice::find()->where("productId=" . $productId)->orderBy("date ASC")->all();
        if (!$returnArray) {
//            throw new \yii\base\Exception;
            if (isset($productPrice)) {
                if (isset($shippingDisCount) && count($shippingDisCount) > 0) {
                    if ($shippingDisCount[$shippingStep - 1]->type == 1) {
                        return $productPrice->price - $shippingDisCount[$shippingStep - 1]->discount;
                    } else {
                        return $productPrice->price * ((100 - $shippingDisCount[$shippingStep - 1]->discount) / 100);
                    }
                } else {
                    return $productPrice->price;
                }
            } else {
                if (isset($shippingDisCount) && count($shippingDisCount) > 0) {
                    if ($shippingDisCount[$shippingStep - 1]->type == 1) {
                        return $productPrice->price - $shippingDisCount[$shippingStep - 1]->discount;
                    } else {
                        return $productPrice->price * ((100 - $shippingDisCount[$shippingStep - 1]->discount) / 100);
                    }
                } else {
                    return $productPrice->price;
                }
            }
        } else {
            $res = [];
            if (isset($productPrice)) {


                if (isset($shippingDisCount) && count($shippingDisCount) > 0) {
                    if ($shippingDisCount[$shippingStep - 1]->type == 1) {
                        $price = $productPrice->price - $shippingDisCount[$shippingStep - 1]->discount;
                    } else {
                        $price = $productPrice->price * ((100 - $shippingDisCount[$shippingStep - 1]->discount) / 100);
                    }
                } else {
                    $price = $productPrice->price;
                }
                $res["discountType"] = isset($productPrice->discountType) ? $productPrice->discountType : NULL;
                $res["discountValue"] = isset($productPrice->discountValue) ? $productPrice->discountValue : NULL;
                $res["discountValueText"] = isset($productPrice->discountValue) ? number_format($productPrice->discountValue, 2) : NULL;
                $res["price"] = $price;
                $res["priceText"] = number_format($price, 2) . " ฿";
            } else {
                if (isset($shippingDisCount) && count($shippingDisCount) > 0) {
                    if ($shippingDisCount[$shippingStep - 1]->type == 1) {
                        $price = $productPrice->price - $shippingDisCount[$shippingStep - 1]->discount;
                    } else {
                        $price = $productPrice->price * ((100 - $shippingDisCount[$shippingStep - 1]->discount) / 100);
                    }
                } else {
                    $price = $productPrice->price;
                }
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

    public static function findMaxQuantity($id, $checkInCart = 1) {
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

    public static function findQuantityInCart($id) {
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

    public function getProductPrices() {
        return $this->hasMany(ProductPrice::className(), ['productId' => 'productId']);
    }

    public function getBestSellProduct() {
        //return $this->hasMany(ProductPrice::className(), ['productId' => 'productId']);
    }

    public function findOutProducts() {
        //return $this->hasMany(ProductPrice::className(), ['productId' => 'productId']);
    }

    public function findOnSellProducts() {
        //return $this->hasMany(ProductPrice::className(), ['productId' => 'productId']);
    }

    public function addProductShipping($id) {
        $date = ShippingType::find()->where("1")->orderBy("date ASC")->all();
        for ($i = 0; $i <= 1; $i++):
            $productShippingPrice = new ProductShippingPrice();
            $productShippingPrice->productId = $id;
            $productShippingPrice->shippingTypeId = $date[$i]->shippingTypeId;
            $productShippingPrice->date = $date[$i]->date;
            $productShippingPrice->discount = 0;
            $productShippingPrice->type = 1;
            $productShippingPrice->createDateTime = new \yii\db\Expression('NOW()');
            $productShippingPrice->updateDateTime = new \yii\db\Expression('NOW()');
            $productShippingPrice->save(false);
        endfor;
    }

    public function getUnits() {
        return $this->hasOne(Unit::className(), ['unitId' => 'unit']);
    }

    public function getImages() {
        return $this->hasOne(ProductImage::className(), ['productId' => 'productId']);
    }

    public static function getShippingTypeId($productId) {
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

    public static function getShippingDate($productId, $type) {
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
        $minDate = 99;
        $findMinDates = ProductShippingPrice::find()->where("productId =" . $productId . " and shippingTypeId!=" . $fastId)->all();
        if (isset($findMinDates)) {
            foreach ($findMinDates as $findMinDate) {
                $model = ShippingType::find()->where("shippingTypeId=" . $findMinDate->shippingTypeId)->one();
                if (isset($model)) {
                    if ($model->date < $minDate) {
                        $minDate = $model->date;
                    }
                }
            }
        } else {
            $minDate = $fastId;
        }

        if ($type == 1) {
            return $fastDate;
        } else {
            return $minDate;
        }
    }

    static public function findProductName($productId) {
        $product = Product::find()->where("productId=" . $productId)->one();
        if (isset($product)) {
            return $product->code;
        } else {
            return '';
        }
    }

    static public function findUnit($productId) {
        $product = Product::find()->where("productId=" . $productId)->one();
        if (isset($product)) {
            $unit = Unit::find()->where("unitId=" . $product->unit)->one();
            return $unit->title;
        } else {
            return '';
        }
    }

    static public function findProductId($barcode) {
        $product = Product::find()->where("isbn='" . $barcode . "'")->one();
        if (isset($product) && !empty($product)) {
            return $product->productId;
        } else {
            return '';
        }
    }

    static public function findProductInPack($orderItemId) {// 28/09/2016  หน้า show product  ที่เอาลงถุงแล้ว
        $orderItem = OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
        if (isset($orderItem) && !empty($orderItem)) {
            $product = Product::find()->where("productId=" . $orderItem->productId)->one();
            if (isset($orderItem) && !empty($orderItem)) {
                return $product->code;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function findProducts($orderItemId) {
        $orderItems = OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
        if (isset($orderItems) && !empty($orderItems)) {
            $product = Product::find()->where("productId=" . $orderItems->productId)->one();
            if (isset($product) && !empty($product)) {
                return $product;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function isSmartItem($productId) {
        $flag = FALSE;
        $cart = Order::findCartArray();
        if (isset($cart['items']) && count($cart['items']) > 0) {
            foreach ($cart['items'] as $orderItemId => $item) {
                $smartItems = ProductPriceMatchGroup::find()
                        ->join("LEFT JOIN", 'product_price_match pm', 'pm.productPriceMatchGroupId=product_price_match_group.productPriceMatchGroupId')
                        ->where("pm.productid =" . $item['productId'])
                        ->one();
                if (isset($smartItems)) {
                    foreach ($smartItems->productPriceMatchs as $ppm) {
                        if ($ppm->productId == $productId) {
                            $flag = TRUE;
                            break;
                        }
                    }
                }
            }
        }

        return $flag;
    }

}
