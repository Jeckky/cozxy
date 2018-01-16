<?php

namespace common\helpers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * Suppliers 14/12/2016 By Taninut.Bm
 */
class Suppliers {

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
                        ->where('order.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' and date(order.createDateTime) >= date_add(curdate(),interval  0 day) ')->one();
        return $productLastDay;
    }

    /*
     * หาสินค้าที่ขายได้ล่าสุด
     * หาจำนวนชิ้น
     * หาราคารวม
     * หาค่าเฉลี่ยจำนวนชิ้นที่ขายได้/วัน
     */

    public static function LastDay($productSuppId) {
        if ($productSuppId != '') {
            $rankOne = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $productSuppId)->one();
            $parentsProductId = $rankOne->attributes['productId'];
            $productLastDay = \common\models\costfit\Order::find()
                            ->select(' sum(`order`.`summary`) as summaryPrice, '
                                    . '(select sum(`order_item`.`quantity`) from `order_item` WHERE `order`.status >= 5 '
                                    . ' and `order_item`.orderId = `order`.orderId  limit 1) as conutProduct, '
                                    . '(select count(`order_item`.`productId`)/7   from `order_item` WHERE `order`.status >= 5 limit 1) as avgNum')
                            ->join('LEFT JOIN', 'order_item', '`order_item`.orderId = `order`.orderId')
                            ->join('LEFT JOIN', 'product_suppliers', '`product_suppliers`.productSuppId = `order_item`.productId')
                            ->where('`order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' and date(order.createDateTime) >= date_add(curdate(),interval  0 day) '
                                    . 'and `product_suppliers`.productId =' . $parentsProductId . ' ')->one();
        } else {
            $productLastDay = \common\models\costfit\Order::find()
                            ->select(' sum(`order`.`summary`) as summaryPrice, '
                                    . '(select sum(`order_item`.`quantity`) from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' '
                                    . ' and `order_item`.orderId = `order`.orderId  limit 1) as conutProduct, '
                                    . '(select count(`order_item`.`productId`)/7   from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' limit 1) as avgNum')
                            ->where('order.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' and date(order.createDateTime) >= date_add(curdate(),interval  0 day) ')->one();
        }
        return $productLastDay;
    }

    /*
     * หาสินค้าที่ขายได้ 7 วันล่าสุด
     * หาจำนวนชิ้น
     * หาราคารวม
     * หาค่าเฉลี่ยจำนวนชิ้นที่ขายได้/วัน
     */

    public static function LastWeek($productSuppId) {
        if ($productSuppId != '') {
            $rankOne = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $productSuppId)->one();
            $parentsProductId = $rankOne->attributes['productId'];

            $productLastWeek = \common\models\costfit\Order::find()
                            ->select(' sum(`order`.`summary`) as summaryPrice, '
                                    . '(select sum(`order_item`.`quantity`) from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' '
                                    . ' and `order_item`.orderId = `order`.orderId limit 1) as conutProduct, '
                                    . '(select count(`order_item`.`productId`)/7   from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' limit 1) as avgNum')
                            ->join('LEFT JOIN', 'order_item', '`order_item`.orderId = `order`.orderId')
                            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
                            ->where('`order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' and order.createDateTime BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() '
                                    . 'and product_suppliers.productId =' . $parentsProductId . ' ')->one();
        } else {
            $productLastWeek = \common\models\costfit\Order::find()
                            ->select('sum(`order`.`summary`) as summaryPrice, '
                                    . '(select sum(`order_item`.`quantity`) from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' '
                                    . ' and `order_item`.orderId = `order`.orderId limit 1) as conutProduct, '
                                    . '(select count(`order_item`.`productId`)/7 from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' limit 1) as avgNum')
//->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
//->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
                            ->where('`order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' and order.createDateTime BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() ')->one();
        }
        return $productLastWeek;
    }

    /*
     * หาสินค้าที่ขายได้ 14 วันล่าสุด
     * หาจำนวนชิ้น
     * หาราคารวม
     * หาค่าเฉลี่ยจำนวนชิ้นที่ขายได้/วัน
     */

    public static function LastWeek14($productSuppId) {
        if ($productSuppId != '') {
            $rankOne = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $productSuppId)->one();
            $parentsProductId = $rankOne->attributes['productId'];

            $product14LastWeek = \common\models\costfit\Order::find()
                            ->select(' sum(`order`.`summary`) as summaryPrice, '
                                    . '(select sum(`order_item`.`quantity`) from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' '
                                    . '  and `order_item`.orderId = `order`.orderId limit 1) as conutProduct, '
                                    . '(select count(`order_item`.`productId`)/7   from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ''
                                    . ' and `order_item`.orderId = `order`.orderId limit 1) as avgNum')
                            ->join('LEFT JOIN', 'order_item', '`order_item`.orderId = `order`.orderId')
                            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
                            ->where('`order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' and order.createDateTime BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()'
                                    . 'and product_suppliers.productId =' . $parentsProductId . ' ')->one();
        } else {
            $product14LastWeek = \common\models\costfit\Order::find()
                            ->select(' sum(`order`.`summary`) as summaryPrice, '
                                    . '(select sum(`order_item`.`quantity`) from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ''
                                    . ' and `order_item`.orderId = `order`.orderId  limit 1) as conutProduct, '
                                    . '(select count(`order_item`.`productId`)/7   from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' limit 1) as avgNum')
//->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
//->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
                            ->where('`order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' and order.createDateTime BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()')->one();
        }
        return $product14LastWeek;
    }

    /*
     * หาสินค้าที่ขายได้ 1 เดือนล่าสุด
     * หาจำนวนชิ้น
     * หาราคารวม
     * หาค่าเฉลี่ยจำนวนชิ้นที่ขายได้/วัน
     */

    public static function LastMonth($productSuppId) {
        if ($productSuppId != '') {
            $rankOne = \common\models\costfit\ProductSuppliers::find()->where('productSuppId = ' . $productSuppId)->one();
            $parentsProductId = $rankOne->attributes['productId'];
            $orderLastMonth = \common\models\costfit\Order::find()
                            ->select(' sum(`order`.`summary`) as summaryPrice, '
                                    . '(select sum(`order_item`.`quantity`) from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' '
                                    . 'and `order_item`.orderId = `order`.orderId  limit 1) as conutProduct, '
                                    . '(select count(`order_item`.`productId`)/7   from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' limit 1) as avgNum')
                            ->join('LEFT JOIN', 'order_item', '`order_item`.orderId = `order`.orderId')
                            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
                            ->where('`order`.`status` >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' and (NOW() - INTERVAL 1 MONTH) <= (NOW() )'
                                    . 'and product_suppliers.productId =' . $parentsProductId . ' ')->one();
        } else {
            $orderLastMonth = \common\models\costfit\Order::find()
                    ->select(' sum(`order`.`summary`) as summaryPrice ,'
                            . '(select sum(`order_item`.`quantity`) from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' '
                            . 'and `order_item`.orderId = `order`.orderId  limit 1) as conutProduct , '
                            . '(select count(`order_item`.`productId`)/7   from `order_item` WHERE `order`.status >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' limit 1) as avgNum')
// ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
//->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
//->where('`order`.status >= 5 and MONTH(curdate()) = MONTH(order.createDateTime) and year(order.createDateTime) = year(curdate())   ')
                    ->where('`order`.`status` >= ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' and (NOW() - INTERVAL 1 MONTH) <= (NOW() ) ')
                    ->one();
        }
        return $orderLastMonth;
    }

    /*
     * หัวข้อ ลำดับราคา
     * แสดงข้อมูลราคาของ Suppliers ที่อยู่ใน Product เดียวกัน
     */

    public static function GetPriceSuppliersSame($brandId, $categoryId, $productSuppId) {
        $rankOne = \common\models\costfit\ProductSuppliers::find()->where('productSuppId = ' . $productSuppId)->one();
        $parentsProductId = $rankOne->attributes['productId'];
        $rankTwo = \common\models\costfit\ProductSuppliers::find()
                ->select('`product_suppliers`.*, product_suppliers.title as pTitle, product_price_suppliers.price as priceSuppliers '
                        . ', product_price_suppliers.price as priceSuppliers')
                ->join('LEFT JOIN', 'product_price_suppliers', 'product_price_suppliers.productSuppId = product_suppliers.productSuppId')
                ->where('product_price_suppliers.status = 1 and product_price_suppliers.price != "" and product_suppliers.productId = ' . $parentsProductId)
                ->orderBy(' product_price_suppliers.price asc');

        $rankingPrice = new ActiveDataProvider([
            'query' => $rankTwo
        ]);
        return $rankingPrice;
    }

    /*
     * - ajax post url yii2: /suppliers/product-price-suppliers/create?
     * - หาลำดับ ราคาของ Supplires
     * table : product_suppliers ,product_price_suppliers
     * where : สถานะราคาของ Suppliers เท่า 1 ,ราคาของ Suppliers ต้องมีค่าเสมอ  และ productId parents เดียวกัน โดยส่ง ราคาจากฟอร์ม
     * */

    public static function SuppliersCreatePrice($price, $productSuppId) {
        $rankOne = \common\models\costfit\ProductSuppliers::find()->where('productSuppId = ' . $productSuppId)->one();
        $parentsProductId = $rankOne->attributes['productId'];
        $rankTwo = \common\models\costfit\ProductSuppliers::find()
                ->select('`product_suppliers`.*, product_suppliers.title as pTitle, product_price_suppliers.price as priceSuppliers '
                        . ', product_price_suppliers.price as priceSuppliers')
                ->join('LEFT JOIN', 'product_price_suppliers', 'product_price_suppliers.productSuppId = product_suppliers.productSuppId')
                ->where('product_price_suppliers.status = 1 and product_price_suppliers.price != "" and '
                        . ' product_suppliers.productId = ' . $parentsProductId . ' and product_price_suppliers.price <=' . $price)
                ->count();

        return $rankTwo;
    }

    /*
     * แสดงรายชื่อของ Suppliers
     * table User : type = 4
     */

    public static function GetUserSuppliers() {
        if (Yii::$app->user->identity->userId == 39) {
            $userGroup = \common\models\costfit\AuthAssignment::find()->where("item_name = 'Partner' ")->all();
        } else {
            $userGroup = \common\models\costfit\AuthAssignment::find()->where("item_name = 'Partner' and user_id = " . Yii::$app->user->identity->userId)->all();
        }
        if (count($userGroup) > 0) {
            foreach ($userGroup as $value) {
                $user[] = \common\models\costfit\User::find()->where('userId =' . $value['user_id'])->all();
            }
        } else {
            $user[] = 'No';
        }

        return $user;
        /*
          Array
          (
          [0] => No
          ) */
    }

    public static function GetUserContents() {
        $userGroup = \common\models\costfit\AuthAssignment::find()->where("item_name = 'Content'")->all();
        foreach ($userGroup as $key => $value) {
            $user[] = \common\models\costfit\User::find()->where('userId =' . $value['user_id'])->all();
        }
        return $user;
    }

    public static function GetCountProduct($userId) {
        $count = \common\models\costfit\ProductSuppliers::find()->where('userId=' . $userId)->count();
        return $count;
    }

    public static function GetCountProductMaster($userId) {
        $count = \common\models\costfit\Product::find()->where('userId=' . $userId)->count();
        return $count;
    }

    public static function GetCountMyProduct($userId) {
        //$count = \common\models\costfit\ProductSuppliers::find()->where('userId=' . $userId )->count();
        $count = \common\models\costfit\Product::find()
                        ->leftJoin('product_suppliers ps', 'product.productId=ps.productId')
                        ->leftJoin('product_price_suppliers pps', 'ps.productSuppId=pps.productSuppId')
                        ->where("product.status=1 AND product.approve='approve'
                        AND ps.status=1
                        AND product.parentId is not null
                        AND ps.approve='approve'
                        AND ps.productId is not null
                        AND ps.result >0
                        AND pps.status=1
                        AND pps.price > 0 and ps.userId =" . $userId)->count();
        return $count;
    }

    public static function GetCountProductApprove($userId) {
        $count = \common\models\costfit\ProductSuppliers::find()->where('userId=' . $userId . ' and approve = "' . \common\models\costfit\ProductSuppliers::SUPPLIERS_APPROVE . '" ')->count();
        return $count;
    }

    public static function GetCountProductWait($userId) {
        $count = \common\models\costfit\ProductSuppliers::find()->where('userId=' . $userId . ' and approve in ("' . \common\models\costfit\ProductSuppliers::SUPPLIERS_NEW . '","' . \common\models\costfit\ProductSuppliers::SUPPLIERS_OLD . '") ')->count();
        return $count;
    }

    public static function GetUser($user_id) {
        $user = \common\models\costfit\User::find()->where('userId =' . $user_id)->one();
        return $user;
    }

    public static function GetProductPrice($productId) {
        $GetProductSuppliers = \common\models\costfit\ProductSuppliers::find()
                ->where("product_suppliers.productId = " . $productId . ' and product_suppliers.result  > 0  ')
                ->one();
        if (isset($GetProductSuppliers['productSuppId'])) {
            $GetPriceSuppliers = \common\models\costfit\ProductPriceSuppliers::find()
                    ->where("productSuppId = " . $GetProductSuppliers['productSuppId'] . ' and product_price_suppliers.status = 1')
                    ->one();
            return number_format($GetPriceSuppliers['price'], 2);
        } else {
            return '-';
        }
        //return $GetProductSuppliers;
    }

    public static function GetMyProductResulte($productId) {
        $result = \common\models\costfit\ProductSuppliers::find()->where('productId=' . $productId)->one();
        return $result['result'];
    }

    /*
     * Frontend : products/frfrmkfmrfrfmrmfrmfrkf
     * Create date : 14/02/2017
     * Crate By : Taninut.Bm
     */

    public static function GetProductSuppliersHelpers($productSuppId) {
        $GetProductSuppliers = \common\models\costfit\ProductSuppliers::find()->where("productSuppId = " . $productSuppId)->one();
        if (isset($GetProductSuppliers) && !empty($GetProductSuppliers)) {
            return $GetProductSuppliers;
        } else {
            return NULL;
        }
    }

}
