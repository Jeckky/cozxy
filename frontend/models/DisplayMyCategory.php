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
class DisplayMyCategory extends Model {

    public static function getResultsCategory() {
        $products = [];
        $category = \common\models\costfit\ProductSuppliers::find()
                ->select('`product_suppliers`.categoryId , `category`.title')
                ->join("LEFT JOIN", "category", "category.categoryId=product_suppliers.categoryId")
                ->groupBy('`product_suppliers`.categoryId')
                ->all();
        foreach ($category as $items) {
            $products[$items->categoryId] = [
                'categoryId' => $items->categoryId,
                'url' => '',
                'title' => $items->title,
            ];
        }
        return $products;
    }

    public static function getResultsCategoryOnline() {
        $category = \common\models\costfit\ProductSuppliers::find()
                ->select('`product_suppliers`.categoryId , `category`.title , count(`product_suppliers`.`categoryId`)')
                ->join("LEFT JOIN", "category", "category.categoryId=product_suppliers.categoryId")
                ->groupBy('`product_suppliers`.categoryId')
                ->orderBy('count(`product_suppliers`.`categoryId`) asc')
                ->limit(12)
                ->all();
        foreach ($category as $value) {
            $params = \common\models\ModelMaster::encodeParams(['categoryId' => $value->categoryId]);
            $strtoupper = strtoupper($value->title);
            $strtolower = strtolower($value->title);
            echo \yii\helpers\Html::a("$strtoupper", ['/search/' . $value->createTitle() . '/' . $params . '?c=' . $strtolower], ['class' => 'menu-item']);
        }
    }

    public static function ShowMenuCategory() {
        $category = \common\models\costfit\CategoryToProduct::find()
                ->select('`category`.categoryId , `category`.title , `category`.parentId ')
                ->join("LEFT JOIN", "category", "category.categoryId = category_to_product.categoryId")
                ->where("category.parentId IS NULL AND category.status=1")
                ->groupBy('category_to_product.categoryId')
                //->orderBy('count(`product_suppliers`.`categoryId`) ASC')
                ->all();
        return $category;
    }

    public static function ShowCategory() {
        $category = \common\models\costfit\Category::find()
                        //->where("category.parentId IS NULL AND category.statusx=1")
                        ->where("category.status=1 and `image` IS NOT NULL and `image` !='' ")
                        ->orderBy(new \yii\db\Expression('rand()'))->limit(6);
        return new ActiveDataProvider([
            'query' => $category,
            'pagination' => false,
        ]);
    }

}
