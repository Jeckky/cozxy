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
        $productSuppId = '';
        $productLastDay = Suppliers::LastDay($productSuppId);
        $productLastWeek = Suppliers::LastWeek($productSuppId);
        $product14LastWeek = Suppliers::LastWeek14($productSuppId);
        $orderLastMONTH = Suppliers::LastMonth($productSuppId);


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
