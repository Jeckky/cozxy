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
class DisplayMyBrand
{

    //put your code here
    public static function MyFilterBrand($categoryId)
    {
        $products = [];
        $categoryIds = \common\models\costfit\CategoryToProduct::find()
        ->select("ctp.*")
        ->join(" LEFT JOIN", "category_to_product ctp", "ctp.productId  = category_to_product.productId")
        ->where("category_to_product.categoryId = $categoryId")
        ->groupBy("ctp.categoryId")
        ->all();
        $cStr = "";
        $i = 1;
        foreach ($categoryIds as $c) {
            $cStr.=$c->categoryId;
            if ($i < count($categoryIds)) {
                $cStr.=",";
            }
            $i++;
        }


        $brand = \common\models\costfit\ProductSuppliers::find()
        ->select(' `brand`.*,product_suppliers.categoryId')
        ->join(" LEFT JOIN", "brand", "brand.brandId  = product_suppliers.brandId")
        ->where("product_suppliers.status = 1 and product_suppliers.approve = 'approve' ")
        ->andWhere("product_suppliers.categoryId IN ($cStr)")
        ->groupBy(['product_suppliers.brandId'])
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
