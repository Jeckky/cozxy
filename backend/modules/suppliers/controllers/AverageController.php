<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductPriceSuppliers;
use common\models\costfit\OrderItem;
use common\models\costfit\Order;
use common\models\costfit\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\AverageSuppliers;

class AverageController extends SuppliersMasterController {

    public function actionIndex() {

        $productLastDay = AverageSuppliers::LastDay();
        $productLastWeek = AverageSuppliers::LastWeek();
        $product14LastWeek = AverageSuppliers::LastWeek14();
        $orderLastMONTH = AverageSuppliers::LastMonth();


        return $this->render('index', [
            'productLastDay' => $productLastDay
            , 'productLastWeek' => $productLastWeek
            , 'orderLastMONTH' => $orderLastMONTH
            , 'product14LastWeek' => $product14LastWeek,
        ]);
        // return $this->render('index');
    }

    public function FunctionName($value = '') {
        # code...
    }

}
