<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use common\models\costfit\Product;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\costfit\ProductSuppliers;
use yii\db\Expression;

/**
 * Description of TestFakeFactory
 *
 * @author it
 */
class TestFakeFactory extends Model {

    public static function productForSale($n = NULL, $cat = FALSE) {
        $products = [];
        $whereArray = [];
        if ($cat != FALSE) {
            $whereArray = [];
            $whereArray["category_to_product.categoryId"] = $cat;

            $whereArray["product_suppliers.approve"] = "approve";
            $whereArray["pps.status"] = "1";

            $pCanSale = \common\models\costfit\CategoryToProduct::find()
            ->select('*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->where($whereArray)
            ->andWhere([">", "ps.result", 0])
            ->orderBy("pps.price ASC , " . new \yii\db\Expression('rand()'))->limit(isset($n) ? $n : 99999)->all();
        } else {
            $pCanSale = \common\models\costfit\ProductSuppliers::find()
            ->select('*')
            ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where(' product_suppliers.approve="approve" and product_suppliers.result > 0 AND product_price_suppliers.status =1 AND '
            . ' product_price_suppliers.price > 0')
//                ->orderBy(new \yii\db\Expression('rand()') . " , product_price_suppliers.price ASC  ")->limit(isset($n) ? $n : 99999)->all();
            ->orderBy("product_price_suppliers.productSuppId , product_price_suppliers.price ASC  ")->limit(isset($n) ? $n : 99999)->all();
        }

        foreach ($pCanSale as $value) {

            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');
            $price_s = isset($value->product) ? number_format($value->product->price) : ''; //number_format($value->product->price, 2);
            $price = number_format($value->price);

            if (Yii::$app->controller->id == 'site') {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            } else {
                $title = isset($value->title) ? $value->title : '';
            }

            $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);

            $products[$value->productSuppId] = [
                'productSuppId' => $value->productSuppId,
                'image' => $productImagesThumbnail1,
                'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                'brand' => isset($value->brand) ? $value->brand->title : '',
                'title' => $title,
                'price_s' => isset($price_s) ? $price_s : '',
                'price' => isset($price) ? $price : '',
                'maxQnty' => isset($value->result) ? $value->result : '',
                'fastId' => FALSE,
                'productId' => isset($value->productId) ? $value->productId : '',
                'supplierId' => isset($value->userId) ? $value->userId : '',
                'receiveType' => isset($value->receiveType) ? $value->receiveType : '1',
                'wishList' => $wishList
            ];
        }

        return $products;
    }

    public static function productForNotSale($n = NULL, $cat = FALSE) {
        $products = [];

        $whereArray2 = [];
        if ($cat != FALSE) {
            $whereArray2["category_to_product.categoryId"] = $params['categoryId'];

//$whereArray2["product_suppliers.approve"] = "approve";
// $whereArray2["ps.result"] = "0";
//$whereArray2["pps.status"] = "1";
            $product = \common\models\costfit\CategoryToProduct::find()
            ->select('*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->where($whereArray2)
            ->andWhere("IF(`ps`.`result` = 0,1,(IF(`ps`.`result` IS NULL,(IF(`product`.productId IS NULL,0,1)),0)))")
            ->andWhere('IF(`pps`.`status` = 1,1,(IF(`pps`.`status` IS NULL,(IF(`product`.productId IS NULL,0,1)),0))) ')
            ->andWhere('IF(`ps`.`approve`="approve",1,(IF(`ps`.`approve` IS NULL,(IF(`product`.productId IS NULL,0,1)),0))) = 1')
            ->orderBy(new \yii\db\Expression('rand()'))->limit(isset($n) ? $n : 99999)->all();
        } else {
            $product = \common\models\costfit\ProductSuppliers::find()
            ->select('*')
            ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where(' product_suppliers.approve="approve" and product_suppliers.result = 0 AND product_price_suppliers.status =1 AND '
            . ' product_price_suppliers.price = 0')
            ->orderBy(new \yii\db\Expression('rand()'))
            ->limit(isset($n) ? $n : 99999)->all();

            $product = Product::find()
            ->leftJoin('category_to_product ctp', ['product.productId' => 'ctp.categoryId'])
            ->where('ctp.productId is null')
//                ->orderBy(new Expression('rand()'))
            ->orderBy('productId')
            ->limit(isset($n) ? $n : 0);
            $dataProvider = new ActiveDataProvider([
                'query' => $product,
                'pagination' => [
                    'pageSize' => isset($n) ? $n : 12,
                ]
            ]);
            return $dataProvider;
        }

        foreach ($product as $value) {

            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');
            if (Yii::$app->controller->id == 'site') {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            } else {
                $title = isset($value->title) ? $value->title : '';
            }

            $price_s = isset($value->product) ? number_format($value->product->price) : ''; //number_format($value->product->price, 2);
            $price = number_format($value->price);
            $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);
            $products[$value->productSuppId] = [
                'productSuppId' => $value->productSuppId,
                'image' => $productImagesThumbnail1,
                'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                'brand' => isset($value->brand) ? $value->brand->title : '',
                'title' => $title,
                'price_s' => $price_s,
                'price' => $price,
                'wishList' => $wishList
            ];
        }

        return $products;
    }

    public static function productHotNewAndProduct($n, $cat = FALSE) {
        $products = [];
        $whereArray = [];

        $pCanSale = \common\models\costfit\OrderItem::find()
        ->select(' sum(`order_item`.quantity) ,`order`.* , `order_item`.*  , `product_suppliers`.*')
        ->join(" LEFT JOIN", "order", "order.orderId  = order_item.orderId")
        ->join(" LEFT JOIN", "product_suppliers", "product_suppliers.productSuppId = order_item.productSuppId")
        ->where('order.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' and  product_suppliers.approve="approve" ')
        ->orderBy([
            'sum(`order_item`.quantity) ' => SORT_DESC,
            ' `order_item`.productId' => SORT_DESC
        ])
        ->limit($n)->all();

        foreach ($pCanSale as $value) {
            if ($value->attributes['orderItemId'] > 0) {

                $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg195x195');
                if (Yii::$app->controller->id == 'product') {
                    $title = isset($value->title) ? substr($value->title, 0, 35) : '';
                } else {
                    $title = isset($value->title) ? $value->title : '';
                }

                $price_s = isset($value->product) ? number_format($value->product->price) : ''; //number_format($value->product->price, 2);
                $price = number_format($value->price);
                $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);
                $products[$value->productSuppId] = [
                    'productSuppId' => $value->productSuppId,
                    'image' => $productImagesThumbnail1,
                    //'image' => isset($productImages->imageThumbnail1) ? Yii::$app->homeUrl . $productImages->imageThumbnail1 : '',
                    //'url' => 'product?id = ' . $value->productSuppId,
                    'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                    'brand' => isset($value->brand) ? $value->brand->title : '',
                    'title' => $title,
                    'price_s' => isset($price_s) ? $price_s : '',
                    'price' => isset($price) ? $price : '',
                    'maxQnty' => $value->result,
                    'fastId' => FALSE,
                    'productId' => $value->productId,
                    'supplierId' => $value->userId,
                    'receiveType' => $value->receiveType,
                    'wishList' => $wishList
                ];
            } else {
                $products[0] = [
                    'productSuppId' => FALSE,
                    'image' => \common\helpers\Base64Decode::DataImageSvg260x260(FALSE, FALSE, FALSE),
                    'url' => FALSE,
                    'brand' => FALSE,
                    'title' => FALSE,
                    'price_s' => FALSE,
                    'price' => FALSE,
                    'maxQnty' => FALSE,
                    'fastId' => FALSE,
                    'productId' => FALSE,
                    'supplierId' => FALSE,
                    'receiveType' => FALSE,
                    'wishList' => FALSE
                ];
            }
        }

        return $products;
    }

    public static function productStory($n) {
        $products = [];
        if ($n == 99) {
            $productPost = \common\models\costfit\ProductPost::find()->where(" userId != 0 and productId is not null and status =1")
            ->groupBy(['productId'])->orderBy(new \yii\db\Expression('rand()'))->all();
        } else {
            $productPost = \common\models\costfit\ProductPost::find()->where(" userId != 0 and productId is not null and status =1 ")
            ->groupBy(['productId'])->orderBy(new \yii\db\Expression('rand()'))->limit($n)->all();
        }
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productId = ' . $value->productId)->all();
            foreach ($productPostList as $items) {
// $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId = ' . $items['productSuppId'])->one();
//$productImages = \common\models\costfit\ProductImage::find()->where('productId = ' . $value->productId)->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId = ' . $items->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = isset($productPrice->price) ? number_format($productPrice->price) : 0;
                $price = isset($productPrice->price) ? number_format($productPrice->price) : 0;
                $rating_score = \common\helpers\Reviews::RatingInProduct($value->productId, $value->productPostId);
                $rating_member = \common\helpers\Reviews::RatingInMember($value->productId, $value->productPostId);
                if ($rating_score == 0 && $rating_member == 0) {
                    $results_rating = 0;
                } else {
                    $results_rating = $rating_score / $rating_member;
                }

                $controller = Yii::$app->urlManager->parseRequest(Yii::$app->request);
//echo $test[0];
//exit();
                if ($controller[0] == '') {
                    $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $items['productSuppId'], 'Svg260x260');
                } else {
                    $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $items['productSuppId'], 'Svg64x64');
                }

                $products[$value->productId] = [
                    'productId' => $value->productId,
                    'productPostId' => $value->productPostId,
                    'image' => $productImagesThumbnail1,
                    //'url' => '/story?id = ' . $items->productSuppId,
                    //'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $items->productId, 'productSupplierId' => $items->productSuppId]),
                    //'url' => Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productId' => $items->productId, 'productSupplierId' => $items->productSuppId,'productSupplierId' => $productSupplierId]),
                    'url' => Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $items->productSuppId]),
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => isset($items->title) ? substr($items->title, 0, 35) : '',
                    'head' => $value->title,
                    'price_s' => $price_s,
                    'price' => $price,
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($value->productPostId)),
                    'star' => number_format($results_rating, 2),
                ];
            }
        }

        return $products;
    }

    public static function productStoryAll($n, $productId, $productSuppId) {
        $products = [];

        $productPost = \common\models\costfit\ProductPost::find()->where("userId != 0 and productId=" . $productId . '  and status =1')->orderBy('productPostId desc')->all();
//throw new \yii\base\Exception(count($productPost));
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productId = ' . $value->productId)->all();
            foreach ($productPostList as $items) {
//$productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId = ' . $productSuppId)->one();
                $productImages = \common\models\costfit\ProductImage::find()->where('productId = ' . $value->productId)->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId = ' . $items->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = number_format($productPrice->price);
                $price = number_format($productPrice->price);
                $rating_score = \common\helpers\Reviews::RatingInProduct($value->productId, $value->productPostId);
                $rating_member = \common\helpers\Reviews::RatingInMember($value->productId, $value->productPostId);
                if ($rating_score == 0 && $rating_member == 0) {
                    $results_rating = 0;
                } else {
                    $results_rating = $rating_score / $rating_member;
                }
                if (isset($productImages->image) && !empty($productImages->image)) {
                    if (file_exists(Yii::$app->basePath . "/web/" . $productImages->image)) {
                        $productImagesThumbnail1 = \Yii::$app->homeUrl . $productImages->image;
                    } else {
                        $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg260x260(FALSE, FALSE, FALSE);
                    }
                } else {
                    $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg260x260(FALSE, FALSE, FALSE);
                }
                $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $productSuppId, 'Svg260x260');

                $products[$value->productPostId] = [
                    'productId' => $value->productId,
                    'productPostId' => $value->productPostId,
                    'image' => $productImagesThumbnail1,
                    //'url' => '/story?id = ' . $items->productSuppId,
                    'url' => Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $items->productSuppId]),
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => isset($items->title) ? substr($items->title, 0, 35) : '',
                    'head' => $value->title,
                    'price_s' => $price_s,
                    'price' => $price,
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($value->productPostId)),
                    'star' => number_format($results_rating, 2),
                ];
            }
        }

        return $products;
    }

    public static function productSlideGroup($n, $status) {
        $products = [];
        $slideGroup = \common\models\costfit\ContentGroup::find()->where("lower(title) = 'banner' and status=1")->one();
        $content = \common\models\costfit\Content::find()->where("contentGroupId =" . $slideGroup['contentGroupId'])->all();
        $newstring = 'abcdef abcdef';

        foreach ($content as $items) {

            $products[$items->contentId] = [
                'code' => $items->contentId,
                'image' => isset($items->image) ? \Yii::$app->homeUrl . substr($items->image, 1) : '',
                'url' => '',
                'head' => $items->headTitle,
                'title' => $items->title,
                'description' => $items->description
            ];
        }

        return $products;
    }

    public static function productViews($productIdParams, $cartOrderId, $selectedOptions) {
        $products = [];
        //$imagAll = [];
        //$GetProductSuppliers = \common\models\costfit\ProductSuppliers::find()->where("productSuppId=" . $productSuppId)->one();

        $getOrderAndItems = \frontend\models\FakeFactory::SearchQuantityInOrder($productIdParams, $cartOrderId);
        //echo 'getOrderAndItems :' . $getOrderAndItems;
        $GetProductSuppliers = \common\models\costfit\ProductSuppliers::find()->where("productId=" . $productIdParams . ' and result >0')->one();
        if (isset($GetProductSuppliers)) {
            //echo '<pre>';
            print_r($getOrderAndItems);
            $quantityOrderItems = $getOrderAndItems; //หาจำนวนสินค้าในเทเบิล OrderItems
            $resultProductSuppliers = $GetProductSuppliers->attributes['result']; //หาจำนวนสินค้าในเทเบิล Product Suppliers
            echo '<br>resultProductSuppliers :' . $resultProductSuppliers;
            if ($resultProductSuppliers >= $quantityOrderItems) { //ถ้าจำนวนสินค้าใน เทเบิล product suppliers มีมากกว่าในเทเบิล orderItems ให้แสดงและค้นหาสินค้าที่มีในสต๊อก
                $GetProductSuppliers = \common\models\costfit\ProductSuppliers::find()
                ->select('`product_suppliers`.*, `product_price_suppliers`.price')
                ->join("LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId=product_suppliers.productSuppId")
                ->where("productId=" . $productIdParams . ' and result >=' . $quantityOrderItems . ' and product_price_suppliers.status = 1')
                ->orderBy('product_price_suppliers.price')
                ->one();
                $txtAlert = 'Ok'; // แสดงปุ่ม Add to cart , add to wishList หรือ SHELVES
            } else {
                $GetProductSuppliers = \common\models\costfit\ProductSuppliers::find()
                ->select('`product_suppliers`.*, `product_price_suppliers`.price')
                ->join("LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId=product_suppliers.productSuppId")
                ->where("productId=" . $productIdParams . ' and product_price_suppliers.status = 1')
                ->orderBy('product_price_suppliers.price')
                ->one();
                $txtAlert = 'No';
            }
        } else {
            $GetProductSuppliers = \common\models\costfit\Product::find()->where("productId=" . $productIdParams)->one();
            $txtAlert = 'No';
        }
        echo '<br>' . $txtAlert;
        $marketPrice = \common\models\costfit\Product::find()->where("productId=" . $productIdParams)->one();

        if (isset($marketPrice)) {
            $market = $marketPrice->price;
        } else {
            $market = 0;
        }
        $GetProductCozxy = isset($GetProductSuppliers->product) ? $GetProductSuppliers->product : $GetProductSuppliers;

        $productImagesMulti = \common\helpers\DataImageSystems::DataImageMasterViewsProdcuts($productIdParams, isset($GetProductSuppliers->attributes['productSuppId']) ? $GetProductSuppliers->attributes['productSuppId'] : 0, 'Svg116x116', 'Svg555x340');
        //throw new \yii\base\Exception(print_r($GetProductSuppliers->attributes, true));
        /* if (isset($GetProductSuppliers['categoryId'])) {
          $GetCategory = \common\models\costfit\Category::find()->where("categoryId=" . $GetProductSuppliers->attributes['categoryId'])->one();
          } */
        /*
         * ราคาสินค้า
         */
        //$price = \common\models\costfit\ProductSuppliers::productPriceSupplier($GetProductSuppliers->attributes['productSuppId']);
        /*
         * wishList
         */
        $wishList = \frontend\models\DisplayMyWishList::productWishList($productIdParams);
        //echo $GetProductSuppliers->product->brand->title;
        //echo $marketPrice->brand->title;
        //echo 'productId :' . $marketPrice->productId . '<hr>';
        //echo $GetProductSuppliers['title'] . '<br>';
        //echo $marketPrice->category->title;
        $products['ProductSuppliersDetail'] = [
            'productSuppId' => isset($marketPrice->productSuppId) ? $marketPrice->productSuppId : $GetProductSuppliers['productSuppId'],
            'productId' => isset($marketPrice->productId) ? $marketPrice->productId : $GetProductSuppliers['productId'],
            //'supplierId' => $GetProductSuppliers['userId'],
            'productGroupId' => '',
            'brandId' => isset($marketPrice->brand->brandId) ? $marketPrice->brand->brandId : $GetProductSuppliers['brandId'],
            'brandName' => isset($marketPrice->brand) ? $marketPrice->brand->title : 'No Brand',
            'categoryId' => isset($marketPrice->categoryId) ? $marketPrice->categoryId : $GetProductSuppliers['categoryId'],
            //'receiveType' => $GetProductSuppliers['receiveType'],
            //   'title' => isset($GetProductSuppliers['title']) ? $GetProductSuppliers['title'] : '',
            'title' => isset($selectedOptions) ? $marketPrice->title : $marketPrice->title,
            'shortDescription' => isset($marketPrice->shortDescription) ? $marketPrice->shortDescription : $GetProductSuppliers['shortDescription'],
            'description' => isset($marketPrice->description) ? $marketPrice->description : $GetProductSuppliers['description'],
            'specification' => isset($marketPrice->specification) ? $marketPrice->specification : $GetProductSuppliers['specification'],
            'quantity' => isset($GetProductSuppliers['quantity']) ? $GetProductSuppliers['quantity'] : '',
            'result' => isset($GetProductSuppliers['result']) ? $GetProductSuppliers['result'] : '',
            'price' => isset($GetProductSuppliers['price']) ? number_format($GetProductSuppliers['price']) : '',
            'category' => isset($marketPrice->category) ? $marketPrice->category->title : 'No Category', //isset($GetCategory->title) ? $GetCategory->title : '',
            //'image' => $productImagesOneTopz,
            //'images' => $imagAll,
            'image' => $productImagesMulti['productImagesOneTopz'],
            'images' => $productImagesMulti['imagAll'],
            'maxQnty' => isset($GetProductSuppliers['result']) ? $GetProductSuppliers['result'] : '',
            'fastId' => FALSE,
            //'productId' => $GetProductSuppliers['productId'],
            'supplierId' => $GetProductSuppliers['userId'],
            'receiveType' => isset($GetProductSuppliers['receiveType']) ? $GetProductSuppliers['receiveType'] : '1',
            'wishList' => $wishList,
            'sendDate' => '',
            'shortDescriptionCozxy' => isset($marketPrice->shortDescription) ? $marketPrice->shortDescription : $GetProductCozxy['specification'],
            'specificationDescriptionCozxy' => isset($marketPrice->specification) ? $marketPrice->specification : $GetProductCozxy['specification'],
            'descriptionCozxy' => isset($marketPrice->description) ? $marketPrice->description : $GetProductCozxy['description'],
            'txtAlert' => $txtAlert, //ตรวจสอบว่ามีจำนวนในสต๊อกหรือเปล่า
            'marketPrice' => isset($market) ? number_format($market) : '',
            'DiscountmarketPrice' => isset($market) ? $market : 0,
            'Discountprice' => isset($GetProductSuppliers['price']) ? $GetProductSuppliers['price'] : 0,
            'productGroupTemplateId' => isset($marketPrice->productGroupTemplateId) ? $marketPrice->productGroupTemplateId : '',
            'parentId' => isset($marketPrice->parentId) ? $marketPrice->parentId : '',
        ];

        return $products;
    }

    public static function productSlideBanner($n, $status) {
        $products = [];
//$brand = \common\models\costfit\Brand::find()->all();
        $brand = \common\models\costfit\Product::find()
        ->select(' `brand`.image as imagebrand, `brand`.brandId as brandId, `brand`.title as title, `brand`.description as description ')
        ->join(" LEFT JOIN", "brand", "brand.brandId  = product.brandId")
        ->where('brand.brandId is not null')
        ->andWhere('product.parentId is not null')
        ->andWhere(['product.approve' => 'approve'])
        ->groupBy(['product.brandId'])
        ->limit($n)->all();

        foreach ($brand as $items) {
            if (isset($items->imagebrand)) {
                if (file_exists(Yii::$app->basePath . "/web" . $items->imagebrand)) {
                    $brandImages = \Yii::$app->homeUrl . substr($items->imagebrand, 1);
                } else {
                    $brandImages = \common\helpers\Base64Decode::DataImageSvg112x64(FALSE, FALSE, FALSE);
                }
            } else {
                $brandImages = \common\helpers\Base64Decode::DataImageSvg112x64(FALSE, FALSE, FALSE);
            }
            $products[$items->brandId] = [
                'brandId' => $items->brandId,
                'image' => $brandImages,
                'url' => Yii::$app->homeUrl . 'search/brand/' . $items->encodeParams(['brandId' => $items->brandId]),
                'title' => $items->title,
                'description' => $items->description
            ];
        }

        return $products;
    }

    public static function productOtherProducts() {
        $productPost = \common\models\costfit\ProductPost::find()->where('userId = 0 and productId is null and status = 1')
        ->orderBy('productPostId desc')->all();
        $products = [];
        foreach ($productPost as $items) {
            if (isset($items->image) && !empty($items->image)) {
                if (file_exists(Yii::$app->basePath . "/web/" . $items->image)) {
                    $brandImages = \Yii::$app->homeUrl . substr($items->image, 1);
                } else {
                    $brandImages = \common\helpers\Base64Decode::DataImageSvg260x260(FALSE, FALSE, FALSE);
                }
            } else {
                $brandImages = \common\helpers\Base64Decode::DataImageSvg260x260(FALSE, FALSE, FALSE);
            }
            $products[$items->productPostId] = [
                'image' => $brandImages,
                'url' => Yii::$app->homeUrl . 'content/' . $items->encodeParams(['productPostId' => $items->productPostId]),
                'title' => $items->title,
                'shortDescription' => $items->shortDescription,
                'description' => $items->description,
            ];
        }

        return $products;
    }

    public static function productPromotion($n = NULL, $cat = FALSE) {
        $products = [];
        $whereArray = [];

        $promotionConfig = \common\models\costfit\Configuration::find()->where("title = 'promotionIds'")->one();
        if (!isset($promotionConfig)) {
            $newPs = ProductSuppliers::find()->where("approve = 'approve' AND result > 0")->orderBy("updateDateTime DESC")->limit(6)->all();
            $promotionIds = "";
            foreach ($newPs as $i => $item) {
                $promotionIds .= $item->productSuppId;
                if ($i < count($newPs) - 1) {
                    $promotionIds .= ",";
                }
            }
            $conf = new \common\models\costfit\Configuration();
            $conf->title = "promotionIds";
            $conf->description = "Product SupplierId สำหรับแสดง Promotion หน้าบ้าน";
            $conf->value = $promotionIds;
            $conf->createDateTime = new yii\db\Expression("NOW()");
            $conf->save();
        } else {
            $promotionIds = $promotionConfig->value;
        }
        if ($cat != FALSE) {
            $whereArray = [];
            $whereArray["category_to_product.categoryId"] = $cat;

            $pCanSale = \common\models\costfit\CategoryToProduct::find()
            ->select('*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->where($whereArray)
            ->andWhere(["in", "ps.productSuppId", $promotionIds])
            ->orderBy("pps.price ASC , " . new \yii\db\Expression('rand()'))->limit(isset($n) ? $n : 99999)->all();
        } else {
            $pCanSale = \common\models\costfit\ProductSuppliers::find()
            ->select('*, product_suppliers.productSuppId as productSuppId')
            ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where(" product_suppliers.productSuppId in ($promotionIds) ")
//            ->orderBy(new \yii\db\Expression('rand()') . " , product_price_suppliers.price ASC  ")->limit($n)->all();
            ->orderBy("product_price_suppliers.price ASC  ")->limit($n)->all();
        }

        foreach ($pCanSale as $value) {

            if (isset($value->productSuppId)) {
                $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');
                $price_s = isset($value->product) ? number_format($value->product->price) : ''; //number_format($value->product->price, 2);
                $price = number_format($value->price);

                if (Yii::$app->controller->id == 'site') {
                    $title = isset($value->title) ? substr($value->title, 0, 35) : '';
                } else {
                    $title = isset($value->title) ? $value->title : '';
                }

                $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);


                $products[$value->productSuppId] = [
                    'productSuppId' => $value->productSuppId,
                    'image' => $productImagesThumbnail1,
                    'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                    'brand' => isset($value->brand) ? $value->brand->title : '',
                    'title' => $title,
                    'price_s' => isset($price_s) ? $price_s : '',
                    'price' => isset($price) ? $price : '',
                    'maxQnty' => isset($value->result) ? $value->result : '',
                    'fastId' => FALSE,
                    'productId' => isset($value->productId) ? $value->productId : '',
                    'supplierId' => isset($value->userId) ? $value->userId : '',
                    'receiveType' => isset($value->receiveType) ? $value->receiveType : '1',
                    'wishList' => $wishList
                ];
            }
        }

//        throw new \yii\base\Exception(print_r($products, true));
        return $products;
    }

    public static function productStoryViewsMore($n, $categoryId) {
        $products = [];
        if ($n == 99) {
            $productPost = \common\models\costfit\ProductPost::find()->where(" userId != 0 and productId is not null and status =1 and isPublic = 1")
            ->groupBy(['productId'])->orderBy(new \yii\db\Expression('rand()'))->all();
        } else {
            $productPost = \common\models\costfit\ProductPost::find()->where(" userId != 0 and productId is not null and status =1 and isPublic = 1")
            ->groupBy(['productId'])->orderBy(new \yii\db\Expression('rand()'))->limit($n)->all();
        }
        foreach ($productPost as $value) {
            if (isset($categoryId)) {
                $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productId = ' . $value->productId . ' and categoryId = ' . $categoryId)->all();
            } else {
                $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productId = ' . $value->productId . ' ')->all();
            }
            if (isset($productPrice->price)) {
                $price = number_format($productPrice->price);
            } else {
                $price = '';
            }
            foreach ($productPostList as $items) {
                //$productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId = ' . $items['productSuppId'])->one();
                //$productImages = \common\models\costfit\ProductImage::find()->where('productId = ' . $value->productId)->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId = ' . $items->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = $price;
                $price = $price;
                $rating_score = \common\helpers\Reviews::RatingInProduct($value->productId, $value->productPostId);
                $rating_member = \common\helpers\Reviews::RatingInMember($value->productId, $value->productPostId);
                if ($rating_score == 0 && $rating_member == 0) {
                    $results_rating = 0;
                } else {
                    $results_rating = $rating_score / $rating_member;
                }

                $controller = Yii::$app->urlManager->parseRequest(Yii::$app->request);
                //echo '<pre>';
                //print_r($controller);
                //echo $test[0];
                //exit();

                if ($controller[0] == '') {
                    $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $items['productSuppId'], 'Svg260x260');
                } else if ($controller[0] == 'story/views-all/') {
                    $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $items['productSuppId'], 'Svg260x260');
                } else {
                    $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $items['productSuppId'], 'Svg64x64');
                }

                $products[$value->productId] = [
                    'productId' => $value->productId,
                    'productPostId' => $value->productPostId,
                    'image' => $productImagesThumbnail1,
                    //'url' => '/story?id = ' . $items->productSuppId,
                    //'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $items->productId, 'productSupplierId' => $items->productSuppId]),
                    //'url' => Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productId' => $items->productId, 'productSupplierId' => $items->productSuppId,'productSupplierId' => $productSupplierId]),
                    'url' => Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $items->productSuppId]),
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => isset($items->title) ? substr($items->title, 0, 35) : '',
                    'head' => isset($value->title) ? substr($value->title, 0, 35) : '',
                    'price_s' => $price_s,
                    'price' => $price,
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($value->productPostId)),
                    'star' => number_format($results_rating, 2),
                    'avatar' => \common\models\costfit\User::getAvatar($value->userId),
                ];
            }
        }

        return $products;
    }

    public static function SearchQuantityInOrder($productId, $cartOrderId) {
        if (isset($cartOrderId['orderId'])) {
            $orderId = $cartOrderId['orderId'];
            $GetQty = \common\models\costfit\Order::find()
            ->select(' count(order_item.quantity) as quantity')
            ->join("LEFT JOIN", "order_item", "order_item.orderId = `order`.orderId")
            ->where('order_item.productId = ' . $productId . ' and `order`.orderId = ' . $orderId . ' and order.status < 5')->count('order_item.quantity');
        } else {
            $GetQty = \common\models\costfit\Order::find()
            ->select(' count(order_item.quantity) as quantity')
            ->join("LEFT JOIN", "order_item", "order_item.orderId = `order`.orderId")
            ->where('order_item.productId = ' . $productId . ' and order.status < 5')->count('order_item.quantity');
        }

        if (isset($GetQty)) {
            return $GetQty;
        } else {
            return FALSE;
        }
        /*
          SELECT  count(`order_item`.quantity) as quantity
          FROM `order` LEFT JOIN `order_item` ON order_item.orderId = `order`.orderId WHERE `order_item`.productId =145 group by `order_item`.productId
         * */
    }

}
