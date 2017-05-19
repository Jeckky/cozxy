<?php

namespace frontend\controllers;
use yii\data\ArrayDataProvider;
use frontend\models\FakeFactory;

class ProductController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $productCanSell = new ArrayDataProvider(['allModels'=>FakeFactory::productForSale(4)]);
        return $this->render('index', compact('productCanSell'));
    }

}
