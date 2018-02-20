<?php

namespace backend\modules\elasticsearch\controllers;

use backend\modules\productmanager\models\Product;
use backend\modules\productmanager\models\ProductSuppliers;
use yii\web\Controller;
use backend\modules\elasticsearch\models\Elastic;
use yii\helpers\Json;

/**
 * Default controller for the `elastic-search` module
 */
class ElasticController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        echo Json::encode(Elastic::product(10505));
    }

    public function actionCreateProduct()
    {
        $productModel = Product::findOne(10505);

//        echo Json::encode($res);
        echo Json::encode(Elastic::createProduct($productModel));
    }

    public function actionCreateProductSupplier()
    {
        $productSuppModel = ProductSuppliers::findOne(2106);
        echo Json::encode(Elastic::createProductSupplier($productSuppModel));
    }
}
