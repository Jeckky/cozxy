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
use common\helpers\Suppliers;

class AverageController extends SuppliersMasterController {

    public function actionIndex() {

        $productLastDay = Suppliers::LastDay();
        $productLastWeek = Suppliers::LastWeek();
        $product14LastWeek = Suppliers::LastWeek14();
        $orderLastMONTH = Suppliers::LastMonth();


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
