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
    public static function MyFilterBrandBk($categoryId) {
        $products = [];
        $categoryIds = \common\models\costfit\CategoryToProduct::find()
                ->select("ctp.*")
                ->join(" LEFT JOIN", "category_to_product ctp", "ctp.productId  = category_to_product.productId")
                ->where(($categoryId = '') ? "category_to_product.categoryId = $categoryId  " : '1=1')
                ->groupBy("ctp.categoryId")
                ->all();
        $cStr = "";
        $i = 1;
        if (count($categoryIds) > 0) {
            foreach ($categoryIds as $c) {
                $cStr .= $c->categoryId;
                if ($i < count($categoryIds)) {
                    $cStr .= ",";
                }
                $i++;
            }
        }


        $brand = \common\models\costfit\ProductSuppliers::find()
                ->select(' `brand`.*,product_suppliers.categoryId')
                ->join(" LEFT JOIN", "brand", "brand.brandId  = product_suppliers.brandId")
                ->where("product_suppliers.status = 1 and product_suppliers.approve = 'approve' ")
                ->andWhere((!empty($cStr)) ? "product_suppliers.categoryId IN ($cStr)" : '1=1 ')
                ->andWhere('brand.title is not null')
                ->groupBy(['product_suppliers.brandId'])
                ->orderBy('brand.title')
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
            ];
        }
        return $products;
    }

    public static function MyFilterBrandNew($brandId) {
        if (isset($brandId)) {
            $whereArray["brandId"] = $brandId;
            $brand = \common\models\costfit\Brand::find()->where($whereArray)->all();
        } else {
            $brand = \common\models\costfit\Brand::find()->all();
        }
        //$brand = \common\models\costfit\Brand::find()->where($whereArray)->all();
        return $brand;
    }

    public static function MyFilterBrand($categoryId) {
        if (isset($categoryId)) {
            /*
             * หา CategoryId และ parentId
             */
            $CategoryFindProduct = \common\models\costfit\Category::find()->where('`categoryId` = ' . $categoryId . ' or  `parentId` = ' . $categoryId . '')->all();
            foreach ($CategoryFindProduct as $value) {
                $category[] = $value['categoryId'];
            }
            /*
             * หา brandId จากเทเบิล Product
             */
            $whereArrayCate["categoryId"] = $category;
            $BendFindProduct = \common\models\costfit\Product::find()
                            ->select(' DISTINCT `brandId`  ')
                            ->where($whereArrayCate)
                            ->andWhere('approve="approve" AND  parentId is not null')->all();
            foreach ($BendFindProduct as $key => $value) {
                $brand[] = $value['brandId'];
            }
            /*
             * หา tile Brand
             */
            if (isset($brand)) {
                $whereArray["brandId"] = $brand;
                $brand = \common\models\costfit\Brand::find()->where($whereArray)->all();
            } else {
                $brand = \common\models\costfit\Brand::find()->all();
            }
        } else {
            $brand = \common\models\costfit\Brand::find()->all();
        }
        //$brand = \common\models\costfit\Brand::find()->where($whereArray)->all();
        return $brand;
    }

    public static function MyFilterBrandMenuCate() {

        $brands = \common\models\costfit\Brand::find()
                ->orderBy(new \yii\db\Expression('rand()'));
        // ->all();
        return new ActiveDataProvider([
            'query' => $brands,
            'pagination' => [
                'pageSize' => 8,
            ]
        ]);
        return $brands;
    }

    public static function MyFilterBrandMenuCateItems() {

        $brands = \common\models\costfit\Brand::find()
                ->orderBy(new \yii\db\Expression('rand()'));
        return new ActiveDataProvider([
            'query' => $brands,
            'pagination' => [
                'pageSize' => 24,
            ]
        ]);
        return $brands;
    }

    public static function MyFilterCatToBrand($categoryId) {
        $test2 = \frontend\controllers\CategoriesController::actionTreeSubToApiElastic($categoryId);

        foreach ($test2 as $key => $value) {
            $categoryArray[$key][] = $value['categoryId'];
            if (isset($value['Children'])) {
                foreach ($value['Children'] as $key => $items) {
                    $categoryArray[$key][] = $items['categoryId'];
                    if (isset($items['Children'])) {
                        foreach ($items['Children'] as $key => $sub) {
                            $categoryArray[$key] = $sub['categoryId'];
                        }
                    }
                }
            }
        }
        $cateToElasticx = '';
        if (isset($categoryArray)) {
            foreach ($categoryArray as $key => $value) {
                $cateToElastic = '';
                foreach ($value as $key => $item) {
                    $cateToElastic .= $item . ',';
                }
                $cateToElasticx .= $cateToElastic;
            }
            $categorySearchId = $cateToElasticx . $categoryId;
        } else {
            $categorySearchId = $categoryId;
        }

        //echo $categorySearchId;
        $brands = \common\models\costfit\ProductSuppliers::find()
                        ->select('brand.* ')
                        ->join(" LEFT JOIN", "brand", "brand.brandId  = product_suppliers.brandId")
                        ->andWhere('product_suppliers.categoryId in (' . $categorySearchId . ')  ')
                        ->groupBy(['product_suppliers.brandId'])
                        ->asArray()->limit(12)->all();

        //print_r($brands);
        return $brands;
    }

    public static function MyFilterCatToSubCate($categoryId) {
        $test2 = \frontend\controllers\CategoriesController::actionTreeSubToApiElastic($categoryId);

        foreach ($test2 as $key => $value) {
            $categoryArray[$key][] = $value['categoryId'];
            if (isset($value['Children'])) {
                foreach ($value['Children'] as $key => $items) {
                    $categoryArray[$key][] = $items['categoryId'];
                    if (isset($items['Children'])) {
                        foreach ($items['Children'] as $key => $sub) {
                            $categoryArray[$key] = $sub['categoryId'];
                        }
                    }
                }
            }
        }
        $cateToElasticx = '';
        if (isset($categoryArray)) {
            foreach ($categoryArray as $key => $value) {
                $cateToElastic = '';
                foreach ($value as $key => $item) {
                    $cateToElastic .= $item . ',';
                }
                $cateToElasticx .= $cateToElastic;
            }
            $categorySearchId = $cateToElasticx . $categoryId;
        } else {
            $categorySearchId = $categoryId;
        }

        //echo $categorySearchId;
        $categories = \common\models\costfit\ProductSuppliers::find()
                        ->select('category.* ')
                        ->join(" LEFT JOIN", "category", "category.categoryId  = product_suppliers.categoryId")
                        ->andWhere('product_suppliers.categoryId in (' . $categorySearchId . ')  and product_suppliers.status=1 and product_suppliers.approve="approve" and product_suppliers.result > 0 ')
                        ->groupBy(['product_suppliers.categoryId'])
                        ->asArray()->all();

        //print_r($brands);
        return $categories;
    }

}
