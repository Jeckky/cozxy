<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * Description of DisplayMyBrand
 *
 * @author it
 */
class DisplayMyBrand {

    //put your code here
    public static function MyFilterBrand($categoryId) {
        $products = [];
        /* $brand = \common\models\costfit\ProductSuppliers::find()
          ->select(' `brand`.*,product_suppliers.categoryId')
          ->join(" LEFT JOIN", "brand", "brand.brandId  = product_suppliers.brandId")
          ->andWhere(isset($categoryId) ? 'product_suppliers.categoryId =' . $categoryId : " 1=1")
          ->groupBy(['product_suppliers.brandId'])
          ->all(); */
        $brand = \common\models\costfit\CategoryToProduct::find()
        ->select('ps.* ,`brand`.title as brandName ')
        ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
        ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
        ->join("LEFT JOIN", "brand", "brand.brandId = ps.brandId")
        ->Where(isset($categoryId) ? 'ps.categoryId =' . $categoryId : " 1=1")
        ->groupBy('ps.productSuppId')
        ->orderBy(['brand.brandId' => SORT_ASC])
        ->all();
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
                'title' => $items->brandName,
            ];
        }
        return $products;
    }

}
