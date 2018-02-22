<?php

namespace frontend\controllers;

use common\models\costfit\Product;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use frontend\models\DisplaySearch;
use frontend\models\FakeFactory;
use frontend\models\DisplayMyCategory;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use yii\data\ActiveDataProvider;
use common\models\costfit\ProductSuppliers;

class ClearanceController extends MasterController {

    public $layout = '@app/themes/cozxy/layoutsV2/main';

    public function actionIndex() {

        if (isset($_GET['c']) && !empty($_GET['c'])) {
            $category = $_GET['c'];
        } else {
            //$k = base64_decode(base64_decode($hash));
            //$params = \common\models\ModelMaster::decodeParams($hash);
            $categoryId = Null;

            $productStory = new ArrayDataProvider(['allModels' => \frontend\models\FakeFactory::productStoryViewsMore(99, $categoryId), 'pagination' => ['defaultPageSize' => 16]]);
        }

        $catPrice = DisplaySearch::findAllPrice($categoryId);

        $productSupplierId = '';

        $productFilterBrand = new ArrayDataProvider(
                [
            'allModels' => \frontend\models\DisplayMyBrand::MyFilterBrand($categoryId)
        ]);

        //$productCanSell = Product::productForSale(12, $categoryId);
        //$productNotSell = Product::productForNotSale(12, $categoryId);

        if ($categoryId != 'undefined') {
            $site = 'category';
        } else {
            $category = FALSE;
            $site = 'brand';
        }

        $productCanSell = $this->productForSale(12, $categoryId);

        return $this->render('index', compact('promotions', 'site', 'productStory', 'productCanSell', 'category', 'categoryId', 'productSupplierId', 'productNotSell', 'productFilterBrand', 'title', 'catPrice'));
    }

    public static function productForSale($n = Null, $categoryId = null, $brandId = null) {
        $products = self::forSale($categoryId, $brandId);

        return new ActiveDataProvider([
            'query' => $products,
            'pagination' => [
                'pageSize' => isset($n) ? $n : 20,
            ]
        ]);
    }

    public static function forSale($categoryId = null, $brandId = null) {
        $products = ProductSuppliers::find()
                ->select('product_suppliers.*, pps.price as price , CEILING(((p.`price` - pps.`price`) / p.`price`) * 100) as specialDiscount ')
                ->leftJoin("product_price_suppliers pps", "pps.productSuppId = product_suppliers.productSuppId")
                ->leftJoin('product p', 'product_suppliers.productId=p.productId')
                ->where('product_suppliers.status=1 and product_suppliers.approve="approve" and product_suppliers.result > 0 AND pps.status =1 AND  pps.price > 0 AND p.approve="approve" AND p.parentId is not null')
                //->orderBy(new Expression('rand()') . " , pps.price");
                ->orderBy(['specialDiscount' => SORT_DESC]);

        if (isset($categoryId)) {
            $products->leftJoin('category_to_product ctp', 'ctp.productId=p.productId');
            $products->andWhere(['ctp.categoryId' => $categoryId]);
        }

        if (isset($brandId)) {
            $products->leftJoin('brand b', 'b.brandId=product_suppliers.brandId');
            $products->andWhere(['b.brandId' => $brandId]);
        }

        return $products;
    }

}
