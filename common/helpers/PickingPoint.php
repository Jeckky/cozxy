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

/**
 * Description of PickingPoint
 *
 * @author it
 */
class PickingPoint {

    //put your code here
    /*
     * Frontend : Checkout
     * Create date : 14/02/2017
     * Crate By : Taninut.Bm
     */

    public static function GetOrderItemrMaster($orderId) {
        $GetOrderItemrMasters = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->one();
        if (isset($GetOrderItemrMasters) && !empty($GetOrderItemrMasters)) {
            return $GetOrderItemrMasters;
        } else {
            return NULL;
        }
    }

    public static function GetOrderItemrGroupMaster($orderId) {
        $GetOrderItemMasters = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->groupBy('receiveType')->all();
        if (isset($GetOrderItemMasters) && !empty($GetOrderItemMasters)) {
            return $GetOrderItemMasters;
        } else {
            return NULL;
        }
    }

    public static function GetOrderItemrGroupLockersMaster($orderId, $type) {
        $GetOrderItemMasters = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId . ' and receiveType =' . $type)->groupBy('receiveType')->one();
        if (isset($GetOrderItemMasters) && !empty($GetOrderItemMasters)) {
            return $GetOrderItemMasters;
        } else {
            return NULL;
        }
    }

    public static function GetOrderItemrGroupBoothMaster($orderId) {
        $GetOrderItemMasters = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_BOOTH)->groupBy('receiveType')->one();
        if (isset($GetOrderItemMasters) && !empty($GetOrderItemMasters)) {
            return $GetOrderItemMasters;
        } else {
            return NULL;
        }
    }

    /*
     * แจ้งเตือนสถานที่ ที่ Customer เคยสั่งซื้อมา ให้แสดงให้เป็นค่า defaut เป็นตัวเลือกในการตัดใจเลือกว่าจะใช้ location เดิมหรือจะเปลียนใหม่
     * create date : 17/02/2017
     * create by : taninut.bm
     */

    public static function HistoryOrderMaster($userId) {
        $HistoryOrderItem = \common\models\costfit\Order::find()->where("userId=" . $userId)
        ->orderBy('orderId desc')
        ->limit(1)
        ->offset(1)->one();
        if (isset($HistoryOrderItem) && !empty($HistoryOrderItem)) {
            return $HistoryOrderItem->attributes;
        } else {
            $HistoryOrderItem = \common\models\costfit\Order::find()->where("userId=" . $userId)
            ->orderBy('orderId desc')
            ->limit(1)->one();
            //return NULL;
            return $HistoryOrderItem->attributes;
        }
    }

    public static function LocationHistoryReceiveTypeLockersInCustomer($orderId, $type) {
        $GetOrderItemHistoryReceive = \common\models\costfit\OrderItem::find()
        ->where("orderId=" . $orderId . ' and receiveType =' . $type)
        ->groupBy('receiveType')->orderBy('createDateTime desc')
        ->all();

        if (isset($GetOrderItemHistoryReceive) && !empty($GetOrderItemHistoryReceive)) {
            return $GetOrderItemHistoryReceive[0]->attributes;
        } else {
            return NULL;
        }
    }

    public static function LocationHistoryReceiveTypeBoothInCustomer($orderId) {
        $GetOrderItemHistoryReceive = \common\models\costfit\OrderItem::find()
        ->where("orderId=" . $orderId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_BOOTH)
        ->groupBy('receiveType')->orderBy('createDateTime desc')
        ->all();
        if (isset($GetOrderItemHistoryReceive) && !empty($GetOrderItemHistoryReceive)) {
            return $GetOrderItemHistoryReceive[0]->attributes;
        } else {
            return NULL;
        }
    }

}
