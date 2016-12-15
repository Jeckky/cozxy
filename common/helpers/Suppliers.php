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
        ->where('order.status >= 5 and date(order.createDateTime) >= date_add(curdate(),interval  0 day) ')->one();
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
            $productLastDay = \common\models\costfit\OrderItem::find()
            ->select('sum(`order_item`.`quantity`) as conutProduct , sum(`order`.`summary`) as  summaryPrice ,count(`order_item`.`productId`)/1 as avgNum'
            . ', (SELECT  sum(`product_suppliers`.`quantity`)  FROM  `product_suppliers`  limit 1)   as  quantitySuppliers,'
            . '(SELECT quantitySuppliers - sum(`order_item`.`quantity`)  FROM  `product_suppliers`   limit 1) as  quantityBalance')
            ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId ')
            ->where('order.status >= 5 and date(order.createDateTime) >= date_add(curdate(),interval  0 day) '
            . ' and product_suppliers.productId =' . $parentsProductId . ' ')->one();
        } else {
            $productLastDay = \common\models\costfit\OrderItem::find()
            ->select('sum(`order_item`.`quantity`) as conutProduct , sum(`order`.`summary`) as  summaryPrice ,count(`order_item`.`productId`)/1 as avgNum'
            . ', (SELECT  sum(`product_suppliers`.`quantity`)  FROM  `product_suppliers`  limit 1)   as  quantitySuppliers,'
            . '(SELECT quantitySuppliers - sum(`order_item`.`quantity`)  FROM  `product_suppliers`   limit 1) as  quantityBalance')
            ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId ')
            ->where('order.status >= 5 and date(order.createDateTime) >= date_add(curdate(),interval  0 day) ')->one();
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
            $productLastWeek = \common\models\costfit\OrderItem::find()
            ->select('sum(`order_item`.`quantity`) as conutProduct, sum(`order`.`summary`) as summaryPrice , count(`order_item`.`productId`)/7 as avgNum ')
            ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
            ->where('`order`.status >= 5 and order.createDateTime BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() '
            . '  and product_suppliers.productId =' . $parentsProductId . ' ')->one();
        } else {
            $productLastWeek = \common\models\costfit\OrderItem::find()
            ->select('sum(`order_item`.`quantity`) as conutProduct, sum(`order`.`summary`) as summaryPrice , count(`order_item`.`productId`)/7 as avgNum ')
            ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
            ->where('`order`.status >= 5 and order.createDateTime BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() ')->one();
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
            $product14LastWeek = \common\models\costfit\OrderItem::find()
            ->select('sum(`order_item`.`quantity`) as conutProduct, sum(`order`.`summary`) as summaryPrice , count(`order_item`.`productId`)/14 as avgNum ')
            ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
            ->where('`order`.status >= 5 and order.createDateTime BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()'
            . '  and product_suppliers.productId =' . $parentsProductId . ' ')->one();
        } else {
            $product14LastWeek = \common\models\costfit\OrderItem::find()
            ->select('sum(`order_item`.`quantity`) as conutProduct, sum(`order`.`summary`) as summaryPrice , count(`order_item`.`productId`)/14 as avgNum ')
            ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
            ->where('`order`.status >= 5 and order.createDateTime BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()')->one();
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
            $orderLastMonth = \common\models\costfit\OrderItem::find()
            ->select('sum(`order_item`.`quantity`) as conutProduct, sum(`order`.`summary`) as summaryPrice, count(`order_item`.`productId`)/30 as avgNum ')
            ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
            ->where('`order`.status >= 5 and MONTH(curdate()) = MONTH(order.createDateTime) and year(order.createDateTime) = year(curdate()) '
            . ' and product_suppliers.productId = ' . $parentsProductId . ' ')->one();
        } else {
            $orderLastMonth = \common\models\costfit\OrderItem::find()
            ->select('sum(`order_item`.`quantity`) as conutProduct, sum(`order`.`summary`) as summaryPrice, count(`order_item`.`productId`)/30 as avgNum ')
            ->join('LEFT JOIN', 'order', 'order.orderId = order_item.orderId')
            ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productId')
            ->where('`order`.status >= 5 and MONTH(curdate()) = MONTH(order.createDateTime) and year(order.createDateTime) = year(curdate())   ')->one();
        }
        return $orderLastMonth;
    }

    /*
     * หัวข้อ ลำดับราคา
     * แสดงข้อมูลราคาของ Suppliers ที่อยู่ใน   brand , category เดียวกัน
     */

    public static function GetPriceSuppliersSame_BK($brandId, $categoryId) {
        $rankTwo = \common\models\costfit\ProductSuppliers::find()
        ->select('`product_suppliers`.*, product_suppliers.title as pTitle, product_price_suppliers.price as priceSuppliers, '
        . 'brand.title as bTitle, category.title as cTitle, user.username as sUser')
        ->join('LEFT JOIN', 'product_price_suppliers', 'product_price_suppliers.productSuppId = product_suppliers.productSuppId')
        ->join('LEFT JOIN', 'brand', 'brand.brandId = product_suppliers.brandId')
        ->join('LEFT JOIN', 'category', 'category.categoryId = product_suppliers.categoryId')
        ->join('LEFT JOIN', 'user', 'user.userId = product_suppliers.userId')
        ->where(' product_price_suppliers.status = 1 and product_suppliers.brandId = ' . $brandId . ' and product_suppliers.categoryId = '
        . '' . $categoryId . ' and product_price_suppliers.price != ""')
        //. ' and date(product_price_suppliers.createDateTime) >= date_add(curdate(), interval -7 day) ')
        ->orderBy(' product_price_suppliers.price asc');
        $rankingPrice = new ActiveDataProvider([
            'query' => $rankTwo
        ]);
        return $rankingPrice;
    }

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
     * table : product_suppliers ,product_price_suppliers , brand ,category ,user
     * where : สถานะราคาของ Suppliers เท่า 1 ,ราคาของ Suppliers ต้องมีค่าเสมอ  และ brand , category เดียวกัน โดยส่ง ราคาจากฟอร์ม
     * */

    public static function SuppliersCreatePrice_Bk($brandId, $categoryId, $price) {
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

}
