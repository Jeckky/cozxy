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

class AverageController extends SuppliersMasterController {

    public function actionIndex() {
        $productLastDay = \common\models\costfit\OrderItem::find()
        ->select('count(order_item.productId) as conutProduct , sum(order.summary) as  summaryPrice ')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId ')
        ->where('order.status >= 5 and date(order.createDateTime) >= date_add(curdate(),interval  0 day) ');
        //. ' and product_suppliers.brandId = ' . $rankOne->brandId . ' and product_suppliers.categoryId = ' . $rankOne->categoryId . ' ')->one(); //->count('order_item.productId');
        $productLastDay = new ActiveDataProvider([
            'query' => $productLastDay
        ]);
        $productLastWeek = \common\models\costfit\OrderItem::find()
        ->select('count(order_item.productId) as conutProduct, sum(order.summary) as summaryPrice ')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
        ->where('`order`.status >= 5 and order.createDateTime BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() ');
        //. 'and product_suppliers.brandId = ' . $rankOne->brandId . ' and product_suppliers.categoryId = ' . $rankOne->categoryId . ' ')->one(); //->count('order_item.productId');

        $product14LastWeek = \common\models\costfit\OrderItem::find()
        ->select('count(order_item.productId) as conutProduct, sum(order.summary) as summaryPrice ')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
        ->where('`order`.status >= 5 and order.createDateTime BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()');
        //. 'and product_suppliers.brandId = ' . $rankOne->brandId . ' and product_suppliers.categoryId = ' . $rankOne->categoryId . ' ')->one(); //->count('order_item.productId');

        $orderLastMONTH = \common\models\costfit\OrderItem::find()
        ->select('count(order_item.productId) as conutProduct, sum(order.summary) as summaryPrice ')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
        ->where('`order`.status >= 5 and MONTH(curdate()) = MONTH(order.createDateTime) and year(order.createDateTime) = year(curdate()) ');
        //. 'and product_suppliers.brandId = ' . $rankOne->brandId . ' and product_suppliers.categoryId = ' . $rankOne->categoryId . ' ')->one(); //->count('order_item.productId');


        return $this->render('index', [
            'productLastDay' => $productLastDay
            , 'productLastWeek' => $productLastWeek
            , 'orderLastMONTH' => $orderLastMONTH
            , 'product14LastWeek' => $product14LastWeek
        ]);
        // return $this->render('index');
    }

    public function FunctionName($value = '') {
        # code...
    }

}
