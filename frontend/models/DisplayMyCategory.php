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

    public static function ShowCategoryOnline() {
        /*
          SELECT   ps.`categoryId` , child.title  , count(ps.`categoryId`) , child.`image` FROM `product_suppliers` ps
          left join `category` child on child.`categoryId` = ps.`categoryId`
          left join category parent on parent.`categoryId` = ps.`categoryId`
          where (ps.status=1 and ps.approve="approve" and ps.result > 0 )  and (child.status = 1 and child.`image` IS NOT NULL and child.`image` !='')
          group by ps.`categoryId`
          order by count(ps.`categoryId`) desc
         */
        /* $category = \common\models\costfit\ProductSuppliers::find()
          ->select('`product_suppliers`.categoryIdx , `category`.title , count(`product_suppliers`.`categoryId`) ,`category`.`image`')
          ->join("LEFT JOIN", "category", "category.categoryId=product_suppliers.categoryId")
          ->where("`category`.status = 1 and `category`.`image` IS NOT NULL and `category`.`image` !=''")
          ->andWhere('product_suppliers.status=1 and product_suppliers.approve="approve" and product_suppliers.result > 0 ')
          ->groupBy('`product_suppliers`.categoryId')
          //->orderBy(new \yii\db\Expression('rand()'), 'count(`product_suppliers`.`categoryId`) desc')
          ->orderBy([
          'count(`product_suppliers`.`title`) ' => SORT_ASC  //Need this line to be fixed
          ])
          ->limit(6); */
        $category = \common\models\costfit\ProductSuppliers::find()
                        ->select(' product_suppliers.`categoryId` , child.title  , count(product_suppliers.`categoryId`) , child.`image`')
                        ->join("LEFT JOIN", "category child", "child.`categoryId` = product_suppliers.`categoryId`")
                        ->join("LEFT JOIN", "category parent", "parent.`categoryId` = product_suppliers.`categoryId`")
                        ->where("product_suppliers.status=1 and product_suppliers.approve='approve' and product_suppliers.result > 0 )  and (child.status = 1   ")
                        ->andWhere(" child.`image` IS NOT NULL and child.`image` !='' ")
                        ->orderBy([
                            'count(`product_suppliers`.`title`) ' => SORT_DESC  //Need this line to be fixed
                        ])
                        ->groupBy('product_suppliers.`categoryId`')->limit(6);
        return new ActiveDataProvider([
            'query' => $category,
            'pagination' => false,
        ]);
    }

}
