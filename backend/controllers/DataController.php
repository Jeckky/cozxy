<?php

namespace backend\controllers;

use common\models\costfit\CategoryToProduct;
use common\models\costfit\ProductSuppliers;
use Yii;
use yii\base\Controller;

/**
 * Site controller
 */
class DataController extends Controller
{
    public function actionInsertProductSupplierToCategoryToProduct()
    {
        $productSuppliers = ProductSuppliers::find()->orderBy('productId')->all();

        foreach($productSuppliers as $ps) {
            $categoryToProduct = CategoryToProduct::find()->where(['categoryId'=>$ps->productId, 'productId'=>$ps->productSuppid])->one();

            if(!isset($categoryToProduct)) {
                echo $ps->productSuppId.'<br>';
            }
        }
    }
}
