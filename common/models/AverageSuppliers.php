<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

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

}
