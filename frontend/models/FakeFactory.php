<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FakeFactory extends Model {

    public static function productForSale($n, $status) {
        $products = [];
        if ($status == 'yes') {
            $pCanSale = \common\models\costfit\ProductSuppliers::find()
            ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where(' product_suppliers.approve="approve" and product_suppliers.result > 0 AND product_price_suppliers.status =1 AND '
            . ' product_price_suppliers.price > 0')
            ->orderBy(new \yii\db\Expression('rand()'))->limit($n)->all();
        } else {
            $pCanSale = \common\models\costfit\ProductSuppliers::find()->where('result = 0 and  approve="approve"')->orderBy(new \yii\db\Expression('rand()'))
            ->orderBy(new \yii\db\Expression('rand()'))->limit($n)->all();
        }
        foreach ($pCanSale as $value) {
            $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('ordering asc')->one();
            $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
            $price_s = number_format($productPrice->price, 2);
            $price = number_format($productPrice->price, 2);
            $products[$value->productSuppId] = [
                'image' => $productImages->image,
                'url' => 'product?id=' . $value->productSuppId,
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
                    'image' => $productImages->image,
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
        /*
          for ($i = 1; $i <= $n; $i++) {
          $price_s = rand(30000, 40000);
          $price = rand(45000, 80000);
          $products[$i] = [
          'image' => 'imgs/product0' . ($i + 3) . '.jpg',
          'url' => 'product?id=' . $i,
          'brand' => 'PRADA',
          'title' => 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG',
          'price_s' => $price_s,
          'price' => $price,
          'views' => rand(555, 888),
          'star' => rand(0.01, 5.00),
          ];
          } */
        return $products;
    }

}
