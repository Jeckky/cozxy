<?php

namespace frontend\controllers;

use frontend\models\FakeFactory;
use yii\data\ArrayDataProvider;

class SearchController extends MasterController {

    public function actionIndex($hash) {
        $productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9)]);
        $category = $_GET['c'];
        return $this->render('index', compact('productCanSell', 'category'));
    }

}
