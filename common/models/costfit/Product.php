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
        return array_merge(parent::rules(), [
            [['storeProductId'], 'safe'],
        ]);
    }

    public function afterFind()
    {
        parent::afterFind();
        if (!$this->isNewRecord) {
            ProductView::saveProductView($this->productId);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), [
            'storeProductId', 'sumViews', 'importQuantity', 'storeProductId', 'storeProductGroupId'
        ]);
    }

    public function getProductOnePrice()
    {
        return $this->hasOne(ProductPrice::className(), ['productId' => 'productId'])->andWhere('quantity = 1');
    }

    public function calProductPrice($productId, $quantity, $returnArray = 0, $fastId = NULL, $orderItemId = NULL)
    {
        $res = [];
        //throw new \yii\base\Exception($productId);
        //$product = Product::find()->where("productId =" . $productId)->one();//เดิม
        //$productPrice = ProductPrice::find()->where("productId =" . $product->productId . " and quantity =" . $quantity)->one();//เดิม
        if ($orderItemId == 'add' || $orderItemId != NULL) {
            $product = Product::find()->where("productId =" . $productId)->one();
            $productPrice = ProductPrice::find()->where("productId =" . $product->productId . " and quantity=" . $quantity)->one();
        } else {
            $product = ProductSuppliers::find()->where("productSuppId =" . $productId)->one();
            $productPrice = ProductPriceSuppliers::find()->where("productSuppId =" . $product->productSuppId . " and status =1 ")->one();
        }
        if (isset($productPrice)) {
            $price = $productPrice->price;
        } else {
            $price = $product->price;
        }
        //$shippingPrice = ProductShippingPrice::calProductShippingPrice($product->productId, $fastId, $orderItemId);//เก่า
        $shippingPrice = ProductShippingPrice::calProductShippingPrice($product->productId, $fastId, $orderItemId);
        if (isset($shippingPrice)) {
            if ($shippingPrice["type"] == 1) {
//                $price = $price - $shippingPrice["discount"];
                $res["shippingDiscountValue"] = $shippingPrice["discount"];
            } else {
//                $price = $price * ((100 - $shippingPrice["discount"]) / 100);
                $res["shippingDiscountValue"] = $price * (($shippingPrice["discount"]) / 100);
            }
        }
        if (!$returnArray) {
            return $price;
        } else {
            $res["discountType"] = isset($productPrice->discountType) ? $productPrice->discountType : NULL;
            $res["discountValue"] = isset($productPrice->discountValue) ? $productPrice->discountValue : NULL;
            $res["discountValueText"] = isset($productPrice->discountValue) ? number_format($productPrice->discountValue, 2) : NULL;
            //throw new \yii\base\Exception($price);
            $res["price"] = $price;
            $res["priceText"] = number_format($price, 2) . " ฿";
            $res["price"] = $price;
            $res["quantity"] = $quantity;


            return $res;
        }
    }

    /* public static function findMaxQuantity($id, $checkInCart = 1) {
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
      } */

    public static function findMaxQuantity($id, $checkInCart = 1)
    {
        $productSupplier = ProductSuppliers::find()->where("productSuppId=" . $id)->one();
        if (isset($productSupplier)) {
            if ($checkInCart) {
                $quantityInCart = Product::findQuantityInCart($id);
                return $productSupplier->result - $quantityInCart;
            } else {
                return $productSupplier->result;
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
            if ($item['productSuppId'] == $id) {
                $quantity = $item['qty'];
                break;
            }
        }

        return $quantity;
    }

    public static function findMaxQuantitySupplier($id, $checkInCart = 1)
    {
        $productSupplier = ProductSuppliers::find()->where("productSuppId=" . $id)->one();
        if (isset($productSupplier)) {
            if ($checkInCart) {
                $quantityInCart = Product::findQuantityInCartSupplier($id);
                return $productSupplier->result - $quantityInCart;
            } else {
                return $productSupplier->result;
            }
        } else {
            return 1;
        }
    }

    public static function findQuantityInCartSupplier($id)
    {
        //$order = Order::getOrder();
        $status = "0,1,2,3,4,8";
        $orderId = '';
        $orders = Order::find()->where("status in ($status)")->all();
        if (isset($orders) && !empty($orders)) {
            foreach ($orders as $order):
                $orderId = $order->orderId . ",";
            endforeach;
            $orderId = substr($orderId, 0, -1);
        }
        $quantity = 0;
        if ($orderId != '') {
            if (isset($order) && !empty($order)) {
                $orderItems = OrderItem::find()->where("orderId in ($orderId) and productSuppId=" . $id)->all();
                if (isset($orderItems) && !empty($orderItems)) {
                    foreach ($orderItems as $item):
                        $quantity += $item->quantity;
                    endforeach;
                }
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
        $fastId = '';
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

    public static function getShippingDate($productId, $type)
    {
        $fastDate = 99;
        //throw new \yii\base\Exception($productId);
        $productShippingDates = ProductShippingPrice::find()->where("productId =" . $productId)->all();
        if (isset($productShippingDates) && !empty($productShippingDates)) {

            foreach ($productShippingDates as $productShippingDate) :
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
            endforeach;
            // throw new \yii\base\Exception(print_r($shippingType, true));
        } else {
            $fastDate = 5;
            $fastId = 5;
        }
        $minDate = '99';
        if (isset($fastId)) {
            $findMinDates = ProductShippingPrice::find()->where("productId =" . $productId . " and shippingTypeId!=" . $fastId)->all();
            if (isset($findMinDates) && !empty($findMinDates)) {
                foreach ($findMinDates as $findMinDate) {
                    $model = ShippingType::find()->where("shippingTypeId=" . $findMinDate->shippingTypeId)->one();
                    if (isset($model)) {
                        if ($model->date < $minDate) {
                            $minDate = $model->date;
                        }
                    }
                }
            } else {
                $minDate = $fastDate;
            }
        }

        if ($type == 1) {
            return $fastDate;
        } else {
            return $minDate;
        }
    }

    static public function findProductName($productId)
    {
        //$product = Product::find()->where("productId=" . $productId)->one();
        $product = ProductSuppliers::find()->where("productSuppId=" . $productId)->one();
        if (isset($product)) {
            return $product->title;
        } else {
            return '';
        }
    }

    static public function findUnit($productId)
    {
        //$product = Product::find()->where("productId=" . $productId)->one();
        $product = ProductSuppliers::find()->where("productSuppId=" . $productId)->one();
        if (isset($product)) {
            $unit = Unit::find()->where("unitId=" . $product->unit)->one();
            return $unit->title;
        } else {
            return '';
        }
    }

    static public function findProductId($barcode)
    {
        // $product = Product::find()->where("isbn='" . $barcode . "'")->one();
        $product = ProductSuppliers::find()->where("isbn='" . $barcode . "'")->one();
        if (isset($product) && !empty($product)) {
            return $product->productSuppId;
        } else {
            return '';
        }
    }

    static public function findProductSuppId($barcode, $orderId)
    {
        $productSupp = OrderItem::find()
        //->select('*.order_item,*.product_suppliers')
        ->join("LEFT JOIN", "product_suppliers ps", "order_item.productSuppId=ps.productSuppId")
        ->where("ps.isbn='" . $barcode . "' and order_item.orderId=" . $orderId . " and order_item.status=5")->one(); //เอาเฉพาะที่ status เป็น หยิบแล้ว

        if (isset($productSupp) && !empty($productSupp)) {
            return $productSupp->productSuppId;
        } else {
            return '';
        }
    }

    static public function findProductIsbn($id)
    {
        $product = Product::find()->where("productId='" . $id . "'")->one();
        if (isset($product) && !empty($product)) {
            return $product->isbn;
        } else {
            return '';
        }
    }

    static public function findProductInPack($orderItemId)
    {// 28/09/2016  หน้า show product  ที่เอาลงถุงแล้ว
        $orderItem = OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
        if (isset($orderItem) && !empty($orderItem)) {
            //$product = Product::find()->where("productId=" . $orderItem->productId)->one();
            $product = ProductSuppliers::find()->where("productsuppId=" . $orderItem->productSuppId)->one();
            if (isset($orderItem) && !empty($orderItem)) {
                return $product->title;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function findProducts($orderItemId)
    {
        $orderItems = OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
        if (isset($orderItems) && !empty($orderItems)) {
            //$product = Product::find()->where("productId=" . $orderItems->productId)->one();
            $product = ProductSuppliers::find()->where("productSuppId=" . $orderItems->productSuppId)->one();
            if (isset($product) && !empty($product)) {
                return $product;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function isSmartItem($productId)
    {
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

    public static function createSupplierProductPrice($productId)
    {
        $products = ProductSuppliers::find()
        ->select('*')
        ->join("LEFT JOIN", 'product_price_suppliers pps', 'product_suppliers.productSuppId=pps.productSuppId')
        ->where("product_suppliers.productId=" . $productId . " and pps.status=1")->one();

        if (isset($products) && !empty($products)) {
            return $products->price;
        } else {
            return NULL;
        }
    }

    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['productId' => 'productId']);
    }

    public static function lowestPrice($productId)
    {
        // throw new \yii\base\Exception($productId);
        $products = ProductSuppliers::find()
        ->join("LEFT JOIN", 'product_price_suppliers pps', 'pps.productSuppId=product_suppliers.productSuppId')
        ->where("product_suppliers.productId=" . $productId . " and product_suppliers.approve='approve' and pps.status=1 and product_suppliers.result>0")
        ->orderBy("pps.price ASC")
        ->one();
        if (isset($products) && !empty($products)) {
            return $products;
        } else {
            return NULL;
        }
    }

    public static function lowestPriceContent($productId)
    {
        //throw new \yii\base\Exception($productId);
        $products = ProductSuppliers::find()
        ->join("LEFT JOIN", 'product_price_suppliers pps', 'pps.productSuppId=product_suppliers.productSuppId')
        ->where("product_suppliers.productId=" . $productId . " and product_suppliers.approve='approve' and pps.status=1 and product_suppliers.result=0")
        ->orderBy("pps.price ASC")
        ->one();
        if (isset($products) && !empty($products)) {
            return $products;
        } else {
            return NULL;
        }
    }

    public static function productSuppId($id, $supplierId)
    {
        $productSuppId = ProductSuppliers::find()->where("productId=" . $id . " and userId=" . $supplierId)->one();
        if (isset($productSuppId) && !empty($productSuppId)) {
            return $productSuppId->productSuppId;
        } else {
            return '';
        }
    }

    /**
     * Relations
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['brandId'=>'brandId']);
    }
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['categoryId'=>'categoryId']);
    }
    public function getProductGroup()
    {
        return $this->hasOne(ProductGroup::className(), ['productGroupId'=>'productGroupId']);
    }
}
