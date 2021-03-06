<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductMaster;
use common\helpers\Base64Decode;
use yii\data\ActiveDataProvider;
use common\models\costfit\ProductSuppliers;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

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

    public $storeProductId;
    public $productSuppUserId;
    public $productTempId;
    public $marketPrice;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
            [['storeProductId'], 'safe'],
            [['productGroupTemplateId', 'title', 'price', 'description'], 'required', 'on' => 'create_pg']
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
            'storeProductId', 'sumViews', 'importQuantity', 'storeProductId', 'storeProductGroupId', 'imagebrand',
            'result', 'isbn', 'sellingPrice', 'resultSupp', 'userIdSupp', 'pbTitle'
        ]);
    }

    public function getProductOnePrice() {
        return $this->hasOne(ProductPrice::className(), ['productId' => 'productId'])->andWhere('quantity = 1');
    }

    public function calProductPrice($productSuppId, $quantity, $returnArray = 0, $fastId = NULL, $orderItemId = NULL) {
        $res = [];
        if ($orderItemId == 'add' || $orderItemId != NULL) {
            $product = Product::find()->where("productId =" . $productSuppId)->one();
            $productPrice = ProductPrice::find()->where("productId =" . $product->productId . " and quantity=" . $quantity)->one();
        } else {
            $product = ProductSuppliers::find()->where("productSuppId =" . $productSuppId)->one();
            $productPrice = ProductPriceSuppliers::find()->where("productSuppId =" . $product->productSuppId . " and status=1 ")->one();
        }
        if (isset($productPrice)) {
            $price = $productPrice->price;
        } else {
            $price = $product->price;
        }
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

    public static function findMaxQuantity($id, $checkInCart = 1) {
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

    public static function findQuantityInCart($id) {
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

    public static function findMaxQuantitySupplier($id, $checkInCart = 1) {
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

    public static function findQuantityInCartSupplier($id) {
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

    public static function getShippingDate($productId, $type) {
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

    static public function findProductName($productId) {
        //$product = Product::find()->where("productId=" . $productId)->one();
        $product = ProductSuppliers::find()->where("productSuppId=" . $productId)->one();
        if (isset($product)) {
            return $product->title;
        } else {
            return '';
        }
    }

    static public function productGroupName($productId) {
        //$product = Product::find()->where("productId=" . $productId)->one();
        $product = Product::find()->where("productId=" . $productId)->one();
        if (isset($product)) {
            return $product->title;
        } else {
            return '';
        }
    }

    static public function findUnit($productId) {
        //$product = Product::find()->where("productId=" . $productId)->one();
        $product = ProductSuppliers::find()->where("productSuppId=" . $productId)->one();
        if (isset($product) && $product->unit != NULL && $product->unit != '') {
            $unit = Unit::find()->where("unitId=" . $product->unit)->one();

            return $unit->title;
        } else {
            return '';
        }
    }

    static public function findProductId($barcode) {
        // $product = Product::find()->where("isbn='" . $barcode . "'")->one();
        $product = ProductSuppliers::find()->where("isbn='" . $barcode . "'")->one();
        if (isset($product) && !empty($product)) {
            return $product->productSuppId;
        } else {
            return '';
        }
    }

    static public function findProductSuppId($barcode, $orderId) {
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

    static public function findProductIsbn($id) {
        $product = Product::find()->where("productId='" . $id . "'")->one();
        if (isset($product) && !empty($product)) {
            return $product->isbn;
        } else {
            return '';
        }
    }

    static public function findProductInPack($orderItemId) {// 28/09/2016  หน้า show product  ที่เอาลงถุงแล้ว
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

    public static function findProducts($orderItemId) {
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

    public static function createSupplierProductPrice($productId) {
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

    public function getProductImages() {
        return $this->hasMany(ProductImage::className(), ['productId' => 'productId'])->orderBy(['product_image.ordering' => SORT_ASC]);
    }

    public static function lowestPrice($productId) {
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

    public static function lowestPriceContent($productId) {
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

    public static function productSuppId($id, $supplierId) {
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
    public function getBrand() {
        return $this->hasOne(Brand::className(), ['brandId' => 'brandId']);
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['categoryId' => 'categoryId']);
    }

    public function getProductGroup() {
        return $this->hasOne(ProductGroup::className(), ['productGroupId' => 'productGroupId']);
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    public static function productSupplierGroup() {
        $productGroup = Product::find()->where("status=1 and userId=" . Yii::$app->user->identity->userId . " AND parentId is NULL")->all();

        return $productGroup;
    }

    public function getProducts() {
        return $this->hasMany(Product::className(), ['parentId' => 'productId']);
    }

    public function productImageThumbnail($thumbnail = 1) {
        $productImageThumbnail = ProductImage::find()->where(['productId' => $this->productId])->orderBy('ordering')->one();
        if (!isset($productImageThumbnail)) {
            //return Base64Decode::DataImageSvg('Svg260x260');
            $productSupplers = \common\models\costfit\ProductSuppliers::find()->where(['productId' => $this->productId])->one();
            $imagesSupplers = \common\models\costfit\ProductImageSuppliers::find()->where(['productSuppId' => $productSupplers['productSuppId']])->orderBy('ordering')->one();
            if (file_exists(Yii::$app->basePath . "/web/" . $imagesSupplers['imageThumbnail1'])) {
                return ($thumbnail == 1) ? $imagesSupplers['imageThumbnail1'] : $imagesSupplers['imageThumbnail2'];
            } else {
                return Base64Decode::DataImageSvg('Svg260x260');
            }
        } else {
            if (file_exists(Yii::$app->basePath . "/web/" . $productImageThumbnail['imageThumbnail1'])) {
                return ($thumbnail == 1) ? $productImageThumbnail['imageThumbnail1'] : $productImageThumbnail['imageThumbnail2'];
            } else {
                $productSupplers = \common\models\costfit\ProductSuppliers::find()->where(['productId' => $this->productId])->one();
                $imagesSupplers = \common\models\costfit\ProductImageSuppliers::find()->where(['productSuppId' => $productSupplers['productSuppId']])->orderBy('ordering')->one();
                if (file_exists(Yii::$app->basePath . "/web/" . $imagesSupplers['imageThumbnail1'])) {
                    return ($thumbnail == 1) ? $imagesSupplers['imageThumbnail1'] : $imagesSupplers['imageThumbnail2'];
                } else {
                    return Base64Decode::DataImageSvg('Svg260x260');
                }
            }
        }
    }

    public static function productImageThumbnail2($productId, $thumbnail = 1) {
        $productImageThumbnail = ProductImage::find()->where(['productId' => $productId])->orderBy('ordering')->one();
        if (!isset($productImageThumbnail)) {
            //return Base64Decode::DataImageSvg('Svg260x260');
            $productSupplers = \common\models\costfit\ProductSuppliers::find()->where(['productId' => $productId])->one();
            $imagesSupplers = \common\models\costfit\ProductImageSuppliers::find()->where(['productSuppId' => $productSupplers['productSuppId']])->orderBy('ordering')->one();
            if (file_exists(Yii::$app->basePath . "/web/" . $imagesSupplers['imageThumbnail1'])) {
                return ($thumbnail == 1) ? $imagesSupplers['imageThumbnail1'] : $imagesSupplers['imageThumbnail2'];
            } else {
                return Base64Decode::DataImageSvg('Svg260x260');
            }
        } else {
            if (file_exists(Yii::$app->basePath . "/web/" . $productImageThumbnail['imageThumbnail1'])) {
                return ($thumbnail == 1) ? $productImageThumbnail['imageThumbnail1'] : $productImageThumbnail['imageThumbnail2'];
            } else {
                $productSupplers = \common\models\costfit\ProductSuppliers::find()->where(['productId' => $productId])->one();
                $imagesSupplers = \common\models\costfit\ProductImageSuppliers::find()->where(['productSuppId' => $productSupplers['productSuppId']])->orderBy('ordering')->one();
                if (file_exists(Yii::$app->basePath . "/web/" . $imagesSupplers['imageThumbnail1'])) {
                    return ($thumbnail == 1) ? $imagesSupplers['imageThumbnail1'] : $imagesSupplers['imageThumbnail2'];
                } else {
                    return Base64Decode::DataImageSvg('Svg260x260');
                }
            }
        }
    }

    public function productImageThumbnail_test($thumbnail = 1) {
        $productImageThumbnail = ProductImage::find()->where(['productId' => $this->productId])->orderBy('ordering')->one();
        if (!isset($productImageThumbnail)) {
            return Base64Decode::DataImageSvg('Svg260x260');
        }

        return ($thumbnail == 1) ? $productImageThumbnail->imageThumbnail1 : $productImageThumbnail->imageThumbnail2;
    }

    public function isInWishlist($productId = Null) {
        if (Yii::$app->user->isGuest)
            return 0;

        $productId = isset($productId) ? $productId : $this->productId; //$this->context->productId
        $wishlist = Wishlist::find()->where(['userId' => Yii::$app->user->id, 'productId' => $productId, 'status' => 1])->count();

        if ($wishlist > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function inStock() {
        return ProductSuppliers::find()
                        ->select('productId')
                        ->where('result>0')
                        ->andWhere(['status' => 1])
                        ->andWhere(['approve' => 'approve'])
                        ->groupBy('productId')
                        ->asArray()
                        ->all();
    }

    public static function notSale($categoryId = NULL, $brandId = null) {
        $productInStock = array_values(ArrayHelper::map(self::inStock(), 'productId', 'productId'));

        $products = self::find()
                ->select('product.*')
                ->leftJoin('product_suppliers ps', ['product.productId' => 'ps.productId'])
                ->where('product.parentId is not null')
                ->andWhere(['product.approve' => 'approve'])
                ->andWhere(['product.status' => 1])
                ->andWhere(['not in', 'product.productId', $productInStock])
                ->orderBy(new Expression('rand()'));
//            ->orderBy('product.productId')
//        ->limit(isset($n) ? $n : 0);

        if (isset($categoryId)) {
            $products->leftJoin('category_to_product ctp', 'ctp.productId=product.productId');
            $products->andWhere(['ctp.categoryId' => $categoryId]);
        }

        if (isset($brandId)) {
            $products->leftJoin('brand b', 'b.brandId=product.brandId');
            $products->andWhere(['b.brandId' => $brandId]);
        }

        return $products;
    }

    public static function productForNotSale($n = NULL, $categoryId = NULL, $brandId = null) {
        $products = self::notSale($categoryId, $brandId);

        return new ActiveDataProvider([
            'query' => $products,
            'pagination' => [
                'pageSize' => isset($n) ? $n : 12,
            ]
        ]);
    }

    public static function forSale($categoryId = null, $brandId = null) {
        $products = ProductSuppliers::find()
                ->select('product_suppliers.*, pps.price as price')
                ->leftJoin("product_price_suppliers pps", "pps.productSuppId = product_suppliers.productSuppId")
                ->leftJoin('product p', 'product_suppliers.productId=p.productId')
                ->where('product_suppliers.status=1 and product_suppliers.approve="approve" and product_suppliers.result > 0 AND pps.status =1 AND  pps.price > 0 AND p.approve="approve" AND p.parentId is not null')
                ->orderBy(new Expression('rand()') . " , pps.price");


        if (isset($categoryId)) {
            $products->leftJoin('category_to_product ctp', 'ctp.productId=p.productId');
            $products->andWhere(['ctp.categoryId' => $categoryId]);
        }

        if (isset($brandId)) {
            $products->leftJoin('brand b', 'b.brandId=product_suppliers.brandId');
            $products->andWhere(['b.brandId' => $brandId]);
        }

        return $products;
    }

    public static function productForSale($n = Null, $categoryId = null, $brandId = null) {
        $products = self::forSale($categoryId, $brandId);

        return new ActiveDataProvider([
            'query' => $products,
            'pagination' => [
                'pageSize' => isset($n) ? $n : 12,
            ]
        ]);
    }

    public static function productForSaleBk($n = Null, $categoryId = null, $brandId = null) {
        /*
          SELECT * FROM cozxy_product_dev.product
          LEFT JOIN `product_suppliers` `ps` ON product.productId=ps.productId
          LEFT JOIN `product_price_suppliers` `pps` ON pps.productSuppId = ps.productSuppId
          WHERE ps.status=1 and ps.approve="approve"
          and ps.result > 0 AND pps.status =1 AND pps.price > 0
          AND product.approve="approve" AND product.parentId is not null
         */
        $products = Product::find()
                ->select('product.*, pps.price as price , ps.result as result, ps.productId as productId, ps.productSuppId as productSuppId')
                ->leftJoin('product_suppliers ps', 'ps.productId=product.productId')
                ->leftJoin("product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
                ->where('ps.status=1 and ps.approve="approve" and ps.result > 0 '
                        . ' AND pps.status =1 AND  pps.price > 0 AND product.approve="approve" AND product.parentId is not null')
                ->orderBy(new Expression('rand()') . " , pps.price");
        if (isset($categoryId)) {
            $products->leftJoin('category_to_product ctp', 'ctp.productId=product.productId');
            $products->andWhere(['ctp.categoryId' => $categoryId]);
        }

        if (isset($brandId)) {
            $products->leftJoin('brand b', 'b.brandId=ps.brandId');
            $products->andWhere(['b.brandId' => $brandId]);
        }

        return new ActiveDataProvider([
            'query' => $products,
            'pagination' => [
                'pageSize' => isset($n) ? $n : 12,
            ]
        ]);
    }

    public static function productPromotion($n = NULL, $cat = false, $brandId = false, $mins = FALSE, $maxs = FALSE, $status = FALSE, $sort = FALSE) {
        //echo $brandId;
        $promotionConfig = \common\models\costfit\Configuration::find()->where("title = 'promotionIds'")->one();
        if (isset($promotionConfig)) {
            $productPromotionIds = $promotionConfig->value;
        } else {
            return NULL;
        }
        $sortStr = ($status == "price") ? "pps.price " : (($status == "brand") ? "b.title " : "product_suppliers.updateDateTime ");
        if ($sort == 'SORT_ASC') {
            $sortStr .= 'asc';
        } else {
            $sortStr .= 'desc';
        }
        $products = ProductSuppliers::find()
                ->select('*, product_suppliers.productSuppId as productSuppId, pps.price as price')
                ->join(" LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = product_suppliers.productSuppId")
                ->leftJoin('product p', 'product_suppliers.productId=p.productId')
                ->where('product_suppliers.status=1 and product_suppliers.approve="approve" and product_suppliers.result > 0 AND pps.status =1 AND  pps.price > 0 AND p.approve="approve" AND p.parentId is not null')
                ->andWhere(['in', 'pps.productSuppId', explode(',', $productPromotionIds)])
                ->andWhere(($maxs > 100) ? 'pps.price ' . 'between ' . $mins . ' and ' . $maxs : " product_suppliers.result >= 0")
                ->orderBy($sortStr);
        //->orderBy(new Expression('rand()') . " , pps.price");
        if (isset($cat) && !empty($cat)) {
            $products->leftJoin('category_to_product ctp', 'ctp.productId=p.productId');
            $products->andWhere(['ctp.categoryId' => $cat]);
        }
        if (Yii::$app->controller->id == 'search') {
            if (isset($brandId) && !empty($brandId)) {
                //if (isset($brandId)) {
                $products->leftJoin('brand b', 'b.brandId=product_suppliers.brandId');
                $products->andWhere(['b.brandId' => $brandId]);
            }
            if ($status == "brand" and ! isset($brandId)) {
                $products->leftJoin('brand b', 'b.brandId=product_suppliers.brandId');
            }
        }

        return new ActiveDataProvider([
            'query' => $products,
            'pagination' => [
                'pageSize' => isset($n) ? $n : 12,
            ]
        ]);
    }

    public static function productForSaleByCategory($categoryId, $filter = []) {
        $products = CategoryToProduct::find()
                ->from('category_to_product ctp')
                ->leftJoin('product p', 'p.productId=ctp.productId')
                ->leftJoin('product_suppliers ps', 'p.productId=ps.productId')
                ->leftJoin('product_price_suppliers pps', 'pps.productSuppId=ps.productSuppId')
                ->where(['ps.approve' => 'approve'])
                ->andWhere(['ctp.categoryId' => $categoryId])
                ->andWhere(['>', 'ps.result', 0])
                ->andWhere(['>', 'pps.price', 0])
                ->orderBy('pps.price');

        if ($filter !== []) {
            if (isset($filter['priceRange'])) {
                $products->andWhere(['between', 'pps.price', $filter['priceRange']['min'], $filter['priceRange']['max']]);
            }

            if (isset($filter['brand'])) {
                $products->leftJoin('brand b', 'b.brandId=p.brandId');
                $products->andWhere(['in', 'b.brandId', $filter['brand']]);
            }
        }

        return new ActiveDataProvider([
            'query' => $products,
            'pagination' => [
                'pageSize' => 12,
            ]
        ]);
    }

    public static function saveProductIsbn($productId, $isbn) {
        $productSupp = \common\models\costfit\ProductSuppliers::find()->where("productId=" . $productId)->all();
        if (isset($productSupp) && count($productSupp) > 0) {
            foreach ($productSupp as $product):
                $product->isbn = $isbn;
                $product->save(false);
            endforeach;
        }
    }

    public static function findProductById($id) {
        return self::find()
                        ->leftJoin('product_suppliers ps', 'product.productId=ps.productId')
                        ->leftJoin('product_price_suppliers pps', 'ps.productSuppId=pps.productSuppId')
                        ->where(['product.productId' => $id])
                        ->andWhere(['ps.status' => 1, 'ps.approve' => 'approve'])
                        ->andWhere(['pps.status' => 1])
                        ->orderBy('pps.price')
                        ->one();
    }

    public static function findProductByIsbn($isbn) {
        return self::find()
                        ->leftJoin('product_suppliers ps', 'product.productId=ps.productId')
                        ->leftJoin('product_price_suppliers pps', 'ps.productSuppId=pps.productSuppId')
                        ->where(['product.isbn' => $isbn])
                        ->andWhere(['ps.status' => 1, 'ps.approve' => 'approve'])
                        ->andWhere(['pps.status' => 1])
                        ->orderBy('pps.price')
                        ->one();
    }

    public function productOptions() {
        $productOptions = ProductGroupOptionValue::find()->where(['productId' => $this->productId])->all();
        return ArrayHelper::map($productOptions, 'productGroupOptionValueId', 'value');
    }

    public static function productBrand($brandId) {
        $products = Brand::find()
                //->select('b.title as pbTitle')
                //->leftJoin('brand b', 'b.brandId=product.brandId')
                ->where('brand.brandId=' . $brandId . '  ')
                ->one();
        return $products;
    }

}
