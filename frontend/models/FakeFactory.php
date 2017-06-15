<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\costfit\ProductSuppliers;

/**
 * ContactForm is the model behind the contact form.
 */
class FakeFactory extends Model {

    public static function productForSale($n, $cat = FALSE) {
        $products = [];
        $whereArray = [];
        if ($cat != FALSE) {
            $whereArray = [];
            $whereArray["category_to_product.categoryId"] = $cat;

            $whereArray["product.approve"] = "approve";
            $whereArray["pps.status"] = "1";

            $pCanSale = \common\models\costfit\CategoryToProduct::find()
            ->select('*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->where($whereArray)
            ->andWhere([">", "ps.result", 0])
            ->orderBy("pps.price ASC , " . new \yii\db\Expression('rand()'))->limit($n)->all();
        } else {
            $pCanSale = \common\models\costfit\ProductSuppliers::find()
            ->select('*')
            ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where(' product_suppliers.approve="approve" and product_suppliers.result > 0 AND product_price_suppliers.status =1 AND '
            . ' product_price_suppliers.price > 0')
            ->orderBy(new \yii\db\Expression('rand()') . " , product_price_suppliers.price ASC  ")->limit($n)->all();
        }

        foreach ($pCanSale as $value) {

            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');
            $price_s = isset($value->product) ? number_format($value->product->price, 2) : ''; //number_format($value->product->price, 2);
            $price = number_format($value->price, 2);

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
                'receiveType' => isset($value->receiveType) ? $value->receiveType : '',
                'wishList' => $wishList
            ];
        }

        return $products;
    }

    public static function productForNotSale($n, $cat = FALSE) {
        $products = [];

        $whereArray2 = [];
        if ($cat != FALSE) {
            $whereArray2["category_to_product.categoryId"] = $params['categoryId'];

            $whereArray2["product.approve"] = "approve";
            $whereArray2["ps.result"] = "0";
            $whereArray2["pps.status"] = "1";
            $product = \common\models\costfit\CategoryToProduct::find()
            ->select('*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->where($whereArray2)
            ->orderBy(new \yii\db\Expression('rand()'))->limit($n)->all();
        } else {
            $product = \common\models\costfit\ProductSuppliers::find()
            ->select('*')
            ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where(' product_suppliers.approve="approve" and product_suppliers.result = 0 AND product_price_suppliers.status =1 AND '
            . ' product_price_suppliers.price = 0')
            ->orderBy(new \yii\db\Expression('rand()'))->limit($n)->all();
        }

        foreach ($product as $value) {

            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');
            if (Yii::$app->controller->id == 'site') {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            } else {
                $title = isset($value->title) ? $value->title : '';
            }

            $price_s = isset($value->product) ? number_format($value->product->price, 2) : ''; //number_format($value->product->price, 2);
            $price = number_format($value->price, 2);
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
        if ($cat != FALSE) {
            $whereArray = [];
            $whereArray["category_to_product.categoryId"] = $cat;

            $whereArray["product.approve"] = "approve";
            $whereArray["pps.status"] = "1";

            $pCanSale = \common\models\costfit\CategoryToProduct::find()
            ->select('*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->where($whereArray)
            ->andWhere([">", "ps.result", 0])
            ->orderBy(new \yii\db\Expression('rand()'))->limit($n)->all();
        } else {
            $pCanSale = \common\models\costfit\ProductSuppliers::find()
            ->select('*')
            ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where(' product_suppliers.approve="approve" and product_suppliers.result > 0 AND product_price_suppliers.status =1 AND '
            . ' product_price_suppliers.price > 0')
            ->orderBy(new \yii\db\Expression('rand()'))->limit($n)->all();
        }
        foreach ($pCanSale as $value) {


            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg195x195');

            if (Yii::$app->controller->id == 'product') {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            } else {
                $title = isset($value->title) ? $value->title : '';
            }
            $price_s = isset($value->product) ? number_format($value->product->price, 2) : ''; //number_format($value->product->price, 2);
            $price = number_format($value->price, 2);
            $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);
            $products[$value->productSuppId] = [
                'productSuppId' => $value->productSuppId,
                'image' => $productImagesThumbnail1,
                //'image' => isset($productImages->imageThumbnail1) ? Yii::$app->homeUrl . $productImages->imageThumbnail1 : '',
                //'url' => 'product?id=' . $value->productSuppId,
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
        }

        return $products;
    }

    public static function productStory($n) {
        $products = [];

        $productPost = \common\models\costfit\ProductPost::find()->where(" userId != 0 and productId is not null  ")
        ->groupBy(['productId'])->orderBy('productPostId desc')->limit($n)->all();
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productId =' . $value->productId)->all();
            foreach ($productPostList as $items) {
                // $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $items['productSuppId'])->one();
                //$productImages = \common\models\costfit\ProductImage::find()->where('productId=' . $value->productId)->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $items->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = number_format($productPrice->price, 2);
                $price = number_format($productPrice->price, 2);
                $rating_score = \common\helpers\Reviews::RatingInProduct($value->productId, $value->productPostId);
                $rating_member = \common\helpers\Reviews::RatingInMember($value->productId, $value->productPostId);
                if ($rating_score == 0 && $rating_member == 0) {
                    $results_rating = 0;
                } else {
                    $results_rating = $rating_score / $rating_member;
                }

                $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $items['productSuppId'], 'Svg64x64');
                $products[$value->productId] = [
                    'productId' => $value->productId,
                    'productPostId' => $value->productPostId,
                    'image' => $productImagesThumbnail1,
                    //'url' => '/story?id=' . $items->productSuppId,
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

        $productPost = \common\models\costfit\ProductPost::find()->where("userId != 0 and productId=" . $productId)->orderBy('productPostId desc')->all();
        //throw new \yii\base\Exception(count($productPost));
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productId =' . $value->productId)->all();
            foreach ($productPostList as $items) {
                //$productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSuppId)->one();
                $productImages = \common\models\costfit\ProductImage::find()->where('productId=' . $value->productId)->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $items->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = number_format($productPrice->price, 2);
                $price = number_format($productPrice->price, 2);
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
                $products[$value->productPostId] = [
                    'productId' => $value->productId,
                    'productPostId' => $value->productPostId,
                    'image' => $productImagesThumbnail1,
                    //'url' => '/story?id=' . $items->productSuppId,
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

    public static function productViews($productSuppId) {
        $products = [];
        //$imagAll = [];
        $GetProductSuppliers = \common\models\costfit\ProductSuppliers::find()->where("productSuppId=" . $productSuppId)->one();
        $GetProductCozxy = $GetProductSuppliers->product;
        //foreach ($GetProductSuppliers as $items) {

        $productImagesMulti = \common\helpers\DataImageSystems::DataImageMasterViewsProdcuts($GetProductSuppliers['productId'], $productSuppId, 'Svg116x116', 'Svg555x340');

        //throw new \yii\base\Exception(print_r($GetProductSuppliers->attributes, true));
        if (isset($GetProductSuppliers['categoryId'])) {
            $GetCategory = \common\models\costfit\Category::find()->where("categoryId=" . $GetProductSuppliers['categoryId'])->one();
        }
        /*
         * ราคาสินค้า
         */
        $price = \common\models\costfit\ProductSuppliers::productPriceSupplier($productSuppId);
        $wishList = \frontend\models\DisplayMyWishList::productWishList($GetProductSuppliers['productSuppId']);
        $products[$GetProductSuppliers['productSuppId']] = [
            'productSuppId' => $GetProductSuppliers['productSuppId'],
            'productId' => $GetProductSuppliers['productId'],
            'supplierId' => $GetProductSuppliers['userId'],
            'productGroupId' => '',
            'brandId' => $GetProductSuppliers['brandId'],
            'categoryId' => $GetProductSuppliers['categoryId'],
            'receiveType' => $GetProductSuppliers['receiveType'],
            'title' => isset($GetProductSuppliers['title']) ? $GetProductSuppliers['title'] : '',
            'shortDescription' => isset($GetProductSuppliers['shortDescription']) ? $GetProductSuppliers['shortDescription'] : '',
            'description' => isset($GetProductSuppliers['description']) ? $GetProductSuppliers['description'] : '',
            'specification' => isset($GetProductSuppliers['specification']) ? $GetProductSuppliers['specification'] : '',
            'quantity' => isset($GetProductSuppliers['quantity']) ? $GetProductSuppliers['quantity'] : '',
            'result' => isset($GetProductSuppliers['result']) ? $GetProductSuppliers['result'] : '',
            'price' => isset($price) ? number_format($price, 2) : '',
            'category' => isset($GetCategory->title) ? $GetCategory->title : '',
            //'image' => $productImagesOneTopz,
            //'images' => $imagAll,
            'image' => $productImagesMulti['productImagesOneTopz'],
            'images' => $productImagesMulti['imagAll'],
            'maxQnty' => $GetProductSuppliers['result'],
            'fastId' => FALSE,
            'productId' => $GetProductSuppliers['productId'],
            'supplierId' => $GetProductSuppliers['userId'],
            'receiveType' => $GetProductSuppliers['receiveType'],
            'wishList' => $wishList,
            'sendDate' => '',
            'shortDescriptionCozxy' => isset($GetProductCozxy['specification']) ? $GetProductCozxy['specification'] : '',
            'descriptionCozxy' => isset($GetProductCozxy['description']) ? $GetProductCozxy['description'] : '',
        ];
        // }

        return $products;
    }

    public static function productSlideBanner($n, $status) {
        $products = [];
        $brand = \common\models\costfit\Brand::find()->all();
        foreach ($brand as $items) {
            if (isset($items->image) && !empty($items->image)) {
                if (file_exists(Yii::$app->basePath . "/web/" . $items->image)) {
                    $brandImages = \Yii::$app->homeUrl . substr($items->image, 1);
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
        $productPost = \common\models\costfit\ProductPost::find()->where('userId=0 and productId is null')
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

}
