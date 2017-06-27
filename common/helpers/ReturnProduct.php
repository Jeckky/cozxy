<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\costfit\StoreProductGroup;
use common\models\costfit\Order;
use common\models\costfit\OrderItem;

//use common\models\costfit\ReturnProduct;

/**
 * Description of Po
 *
 * @author it , Taninut.Bm
 * create date : 27/03/2017
 * Support Suppliers.
 * emial : taninut.b@cozxy.com , sodapew17@gmial.com
 */
class ReturnProduct {
    /*
     * หารายการของใบ Po
     */

    public static function returnDate($updateDateTime) {
        $now = date('Y-m-d H:i:s');
        $date = (strtotime($now) - strtotime($updateDateTime)) / ( 60 * 60 * 24 );
        if ($date <= 7) {
            return true;
        } else {
            return false;
        }
    }

    public static function isMoreItem($orderNo) {
        $order = Order::find()->where("orderNo='" . $orderNo . "'")->one();
        $orderItems = OrderItem::find()->where("orderId=" . $order->orderId)->all();
        $quantity = [];
        $canMakeTicket = 0;
        if (isset($orderItems) && count($orderItems) > 0) {
            foreach ($orderItems as $item):
                $quantity[$item->productSuppId] = $item->quantity;
            endforeach;
        }
        if (!empty($quantity)) {
            foreach ($quantity as $productSuppId => $qnty):
                $totalReturn = 0;
                $returnProducts = \common\models\costfit\ReturnProduct::find()->where("orderId=" . $order->orderId . " and productSuppId=" . $productSuppId)->all();
                if (isset($returnProducts) && count($returnProducts) > 0) {
                    foreach ($returnProducts as $inReturn):
                        $totalReturn += $inReturn->quantity;
                    endforeach;
                    if ($totalReturn < $qnty) {//จำนวนรวมที่คืนไปแล้ว น้อยกว่า จำนวนที่ซื้อทั้งหมด
                        $canMakeTicket++;
                    }
                } else {
                    $canMakeTicket++;
                }
            endforeach;
        }
        if ($canMakeTicket > 0) {//ยังมีสินค้าที่สามารถคืนได้
            return true;
        } else {
            return false;
        }
    }

}
