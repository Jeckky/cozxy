<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * Login form
 */
class AverageSuppliers extends Model {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
        //
        ];
    }

    public static function LastAverage($avgNum, $date) {
        $productLastDay = \common\models\costfit\OrderItem::find()
        ->select('count(`order_item`.`productId`) as conutProduct , sum(`order`.`summary`) as  summaryPrice ,count(`order_item`.`productId`)/1 as avgNum')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId ')
        ->where('order.status >= 5 and date(order.createDateTime) >= date_add(curdate(),interval  0 day) ')->one();
        return $productLastDay;
    }

    public static function LastDay() {
        $productLastDay = \common\models\costfit\OrderItem::find()
        ->select('count(`order_item`.`productId`) as conutProduct , sum(`order`.`summary`) as  summaryPrice ,count(`order_item`.`productId`)/1 as avgNum')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId ')
        ->where('order.status >= 5 and date(order.createDateTime) >= date_add(curdate(),interval  0 day) ')->one();
        return $productLastDay;
    }

    public static function LastWeek() {
        $productLastWeek = \common\models\costfit\OrderItem::find()
        ->select('count(`order_item`.`productId`) as conutProduct, sum(`order`.`summary`) as summaryPrice , count(`order_item`.`productId`)/7 as avgNum ')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
        ->where('`order`.status >= 5 and order.createDateTime BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() ')->one();
        return $productLastWeek;
    }

    public static function LastWeek14() {
        $product14LastWeek = \common\models\costfit\OrderItem::find()
        ->select('count(`order_item`.`productId`) as conutProduct, sum(`order`.`summary`) as summaryPrice , count(`order_item`.`productId`)/14 as avgNum ')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
        ->where('`order`.status >= 5 and order.createDateTime BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()')->one();
        return $product14LastWeek;
    }

    public static function LastMonth() {
        $orderLastMonth = \common\models\costfit\OrderItem::find()
        ->select('count(`order_item`.`productId`) as conutProduct, sum(`order`.`summary`) as summaryPrice , count(`order_item`.`productId`)/30 as  avgNum  ')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
        ->where('`order`.status >= 5 and MONTH(curdate()) = MONTH(order.createDateTime) and year(order.createDateTime) = year(curdate()) ')->one();
        return $orderLastMonth;
    }

    public static function GetPriceSuppliersSame($brandId, $categoryId) {
        $rankTwo = \common\models\costfit\ProductSuppliers::find()
        ->select('`product_suppliers`.* , product_suppliers.title as pTitle, product_price_suppliers.price  as priceSuppliers ,'
        . 'brand.title as bTitle,category.title as cTitle , user.username as sUser')
        ->join('LEFT JOIN', 'product_price_suppliers', 'product_price_suppliers.productSuppId = product_suppliers.productSuppId')
        ->join('LEFT JOIN', 'brand', 'brand.brandId = product_suppliers.brandId')
        ->join('LEFT JOIN', 'category', 'category.categoryId = product_suppliers.categoryId')
        ->join('LEFT JOIN', 'user', 'user.userId = product_suppliers.userId')
        ->where(' product_price_suppliers.status =1  and   product_suppliers.brandId=' . $brandId . ' and product_suppliers.categoryId='
        . '' . $categoryId . ' and product_price_suppliers.price != ""')
        //. '  and  date(product_price_suppliers.createDateTime) >= date_add(curdate(),interval -7 day)     ')
        ->orderBy(' product_price_suppliers.price asc');
        $rankingPrice = new ActiveDataProvider([
            'query' => $rankTwo
        ]);
        return $rankingPrice;
    }

    public static function SuppliersCreatePrice($brandId, $categoryId, $price) {
        $rankTwo = \common\models\costfit\ProductSuppliers::find()
        ->select('`product_suppliers`.*, product_suppliers.title as pTitle, product_price_suppliers.price as priceSuppliers, '
        . 'brand.title as bTitle, category.title as cTitle, user.username as sUser')
        ->join('LEFT JOIN', 'product_price_suppliers', 'product_price_suppliers.productSuppId = product_suppliers.productSuppId')
        ->join('LEFT JOIN', 'brand', 'brand.brandId = product_suppliers.brandId')
        ->join('LEFT JOIN', 'category', 'category.categoryId = product_suppliers.categoryId')
        ->join('LEFT JOIN', 'user', 'user.userId = product_suppliers.userId')
        ->where(' product_price_suppliers.status = 1 and product_suppliers.brandId = ' . $brandId . ' and product_suppliers.categoryId = '
        . '' . $categoryId . ' and product_price_suppliers.price != "" and product_price_suppliers.price <= ' . $price)
        ->count();
        return $rankTwo;
    }

}
