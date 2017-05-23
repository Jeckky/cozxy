<?php

namespace frontend\controllers;

use frontend\models\FakeFactory;
use yii\data\ArrayDataProvider;

class SearchController extends MasterController {

    public function actionIndex($hash) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $categoryId = $params['categoryId'];
        $productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9, $categoryId)]);
        $category = $_GET['c'];
        return $this->render('index', compact('productCanSell', 'category'));
    }

}
