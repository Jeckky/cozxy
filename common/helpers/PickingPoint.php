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

    public static function GetOrderItemrGroupLockersMaster($orderId) {
        $GetOrderItemMasters = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS)->groupBy('receiveType')->all();
        if (isset($GetOrderItemMasters) && !empty($GetOrderItemMasters)) {
            return $GetOrderItemMasters;
        } else {
            return NULL;
        }
    }

    public static function GetOrderItemrGroupBoothMaster($orderId) {
        $GetOrderItemMasters = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_BOOTH)->groupBy('receiveType')->all();
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

    public static function LocationHistoryReceiveTypeLockersInCustomer($userId) {
        $GetOrderItemHistoryReceive = \common\models\costfit\OrderItem::find()->where("userId=" . $userId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS)->groupBy('receiveType')->all();
        if (isset($GetOrderItemHistoryReceive) && !empty($GetOrderItemHistoryReceive)) {
            return $GetOrderItemHistoryReceive;
        } else {
            return NULL;
        }
    }

    public static function LocationHistoryReceiveTypeBoothInCustomer($userId) {
        $GetOrderItemHistoryReceive = \common\models\costfit\OrderItem::find()->where("userId=" . $userId . ' and receiveType =' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_BOOTH)->groupBy('receiveType')->all();
        if (isset($GetOrderItemHistoryReceive) && !empty($GetOrderItemHistoryReceive)) {
            return $GetOrderItemHistoryReceive;
        } else {
            return NULL;
        }
    }

}
