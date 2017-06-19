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
    public static function MyFilterBrand($cats) {
        $products = [];
        $brand = \common\models\costfit\ProductSuppliers::find()
        ->select(' `brand`.*')
        ->join(" LEFT JOIN", "brand", "brand.brandId  = product_suppliers.brandId")
        ->andWhere(isset($cats) ? 'brand.brandId =' . $cats : " 1=1")
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
                'title' => $items->title,
                'description' => $items->description
            ];
        }
        return $products;
    }

}
