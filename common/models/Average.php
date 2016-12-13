<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Average extends Model {

    public $email;
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
        //
        ];
    }

    public function LastDay() {
        $productLastDay = \common\models\costfit\OrderItem::find()
        ->select('count(`order_item`.`productId`) as conutProduct , sum(`order`.`summary`) as  summaryPrice ,count(`order_item`.`productId`)/1 as avgNum')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId ')
        ->where('order.status >= 5 and date(order.createDateTime) >= date_add(curdate(),interval  0 day) ')->one();
    }

    public function LastWeek() {
        $productLastWeek = \common\models\costfit\OrderItem::find()
        ->select('count(`order_item`.`productId`) as conutProduct, sum(`order`.`summary`) as summaryPrice , count(`order_item`.`productId`)/7 as avgNum ')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
        ->where('`order`.status >= 5 and order.createDateTime BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() ')->one();
    }

    public function LastWeek14() {
        $product14LastWeek = \common\models\costfit\OrderItem::find()
        ->select('count(`order_item`.`productId`) as conutProduct, sum(`order`.`summary`) as summaryPrice , count(`order_item`.`productId`)/14 as avgNum ')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
        ->where('`order`.status >= 5 and order.createDateTime BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()')->one();
    }

    public function LastMonth() {
        $orderLastMONTH = \common\models\costfit\OrderItem::find()
        ->select('count(`order_item`.`productId`) as conutProduct, sum(`order`.`summary`) as summaryPrice , count(`order_item`.`productId`)/30 as  avgNum  ')
        ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
        ->where('`order`.status >= 5 and MONTH(curdate()) = MONTH(order.createDateTime) and year(order.createDateTime) = year(curdate()) ')->one();
    }

}
