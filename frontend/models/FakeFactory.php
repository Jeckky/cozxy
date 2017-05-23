<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FakeFactory extends Model {

    public static function productForSale($n) {
        $products = [];

        $pCanSale = \common\models\costfit\ProductSuppliers::find()
        ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
        ->where(' product_suppliers.approve="approve" and product_suppliers.result > 0 AND product_price_suppliers.status =1 AND '
        . ' product_price_suppliers.price > 0')
        ->orderBy(new \yii\db\Expression('rand()'))->limit($n)->all();
        //$model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productSuppId])
        foreach ($pCanSale as $value) {
            $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('ordering asc')->one();
            $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
            $price_s = number_format($productPrice->price, 2);
            $price = number_format($productPrice->price, 2);
            $products[$value->productSuppId] = [
                'image' => $productImages->imageThumbnail1,
                //'url' => 'product?id=' . $value->productSuppId,
                'url' => '/product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                'brand' => isset($value->brand) ? $value->brand->title : '',
                'title' => $value->title,
                'price_s' => $price_s,
                'price' => $price,
            ];
        }
        /*
          for ($i = 1; $i <= $n; $i++) {
          $price_s = rand(30000, 40000);
          $price = rand(45000, 80000);
          $products[$i] = [
          'image' => 'imgs/product0' . ($i) . '.jpg',
          'url' => 'product?id=' . $i,
          'brand' => 'PRADA',
          'title' => 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG',
          'price_s' => $price_s,
          'price' => $price,
          ];
          } */
        return $products;
    }

    public static function productForNotSale($n) {
        $products = [];

        $pCanSale = \common\models\costfit\ProductSuppliers::find()->where('result = 0 and  approve="approve"')->orderBy(new \yii\db\Expression('rand()'))
        ->orderBy(new \yii\db\Expression('rand()'))->limit($n)->all();

        foreach ($pCanSale as $value) {
            $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('ordering asc')->one();
            $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
            $price_s = number_format($productPrice->price, 2);
            $price = number_format($productPrice->price, 2);
            $products[$value->productSuppId] = [
                'image' => $productImages->imageThumbnail1,
                //'url' => 'product?id=' . $value->productSuppId,
                'url' => 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                'brand' => isset($value->brand) ? $value->brand->title : '',
                'title' => $value->title,
                'price_s' => $price_s,
                'price' => $price,
            ];
        }
        /*
          for ($i = 1; $i <= $n; $i++) {
          $price_s = rand(30000, 40000);
          $price = rand(45000, 80000);
          $products[$i] = [
          'image' => 'imgs/product0' . ($i) . '.jpg',
          'url' => 'product?id=' . $i,
          'brand' => 'PRADA',
          'title' => 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG',
          'price_s' => $price_s,
          'price' => $price,
          ];
          } */
        return $products;
    }

    public static function productStory($n) {
        $products = [];
        $productPost = \common\models\costfit\ProductPost::find()->groupBy(['productSuppId'])->orderBy('productPostId desc')->limit($n)->all();
        foreach ($productPost as $value) {
            $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
            foreach ($productPostList as $items) {
                $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $items->productSuppId)->orderBy('ordering asc')->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $items->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = number_format($productPrice->price, 2);
                $price = number_format($productPrice->price, 2);
                $rating_score = \common\helpers\Reviews::RatingInProduct($value->productSuppId, $value->productPostId);
                $rating_member = \common\helpers\Reviews::RatingInMember($value->productSuppId, $value->productPostId);
                if ($rating_score == 0 && $rating_member == 0) {
                    $results_rating = 0;
                } else {
                    $results_rating = $rating_score / $rating_member;
                }
                $products[$value->productSuppId] = [
                    'image' => $productImages->imageThumbnail1,
                    'url' => 'product?id=' . $items->productSuppId,
                    'brand' => isset($items->brand) ? $items->brand->title : '',
                    'title' => $items->title,
                    'price_s' => $price_s,
                    'price' => $price,
                    'views' => number_format(\common\models\costfit\ProductPost::getCountViews($value->productPostId)),
                    'star' => rand($results_rating, 5.00),
                ];
            }
        }

        return $products;
    }

    public static function productSlideGroup($n, $status) {
        $products = [];
        $slideGroup = \common\models\costfit\ContentGroup::find()->where("lower(title) = 'banner' and status=1")->one();
        $content = \common\models\costfit\Content::find()->where("contentGroupId =" . $slideGroup['contentGroupId'])->all();
        foreach ($content as $items) {
            $products[$items->contentId] = [
                'code' => $items->contentId,
                'image' => $items->image,
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
        $imagAll = [];
        $GetProductSuppliers = \common\models\costfit\ProductSuppliers::find()->where("productSuppId=" . $productSuppId)->one();
        foreach ($GetProductSuppliers as $items) {
            /*
             * รูปสินค้า
             */
            $productImagesOneTop = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSuppId)->orderBy('ordering asc')->one();
            $productImagesAll = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSuppId . ' and productImageId !='
            . $productImagesOneTop->productImageId)->orderBy('ordering asc')->all();
            foreach ($productImagesAll as $items) {
                $imagAll[$items['productImageId']] = [
                    //'image' => $items['image'],
                    'imageThumbnail1' => $items['imageThumbnail1'],
                //'imageThumbnail2' => $items['imageThumbnail2']
                ];
            }
            $GetCategory = \common\models\costfit\Category::find()->where("categoryId=" . $GetProductSuppliers['categoryId'])->one();
            /*
             * ราคาสินค้า
             */
            $price = \common\models\costfit\ProductSuppliers::productPriceSupplier($productSuppId);
            $products[$GetProductSuppliers['productSuppId']] = [
                'productSuppId' => '',
                'productId' => '',
                'userId' => '',
                'productGroupId' => '',
                'brandId' => '',
                'categoryId' => '',
                'title' => isset($GetProductSuppliers['title']) ? $GetProductSuppliers['title'] : '',
                'shortDescription' => isset($GetProductSuppliers['shortDescription']) ? $GetProductSuppliers['shortDescription'] : '',
                'description' => isset($GetProductSuppliers['description']) ? $GetProductSuppliers['description'] : '',
                'specification' => isset($GetProductSuppliers['specification']) ? $GetProductSuppliers['specification'] : '',
                'quantity' => isset($GetProductSuppliers['quantity']) ? $GetProductSuppliers['quantity'] : '',
                'result' => isset($GetProductSuppliers['result']) ? $GetProductSuppliers['result'] : '',
                'price' => isset($price) ? number_format($price, 2) : '',
                'category' => isset($GetCategory->title) ? $GetCategory->title : '',
                'image' => $productImagesOneTop['image'],
                'images' => $imagAll
            ];
        }

        return $products;
    }

}
