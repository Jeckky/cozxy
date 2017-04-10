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
 * Description of Lockers
 *
 * @author it
 * Create date : 16/1/2017
 * By Taninut.BM
 * emial : taninut.b@cozxy.com , sodapew17@gmial.com
 *
 */
class Lockers {
    /*
     * แสดงสถานที่ตั้งของ Lockers
     * Create date : 16/1/2017
     * By Taninut.BM
     */

//put your code here

    /*
     * Get ข้อมูลของ PickingPoint
     * Create Date : 25/01/2017
     * By : Taninut.Bm
     */
    public static function GetPickingPoint($pickingId) {
        $listPoint = \common\models\costfit\PickingPoint::find()->where("pickingId = '" . $pickingId . "'")->one();
        return isset($listPoint) ? $listPoint : NULL;
    }

    /*
     * Get ข้อมูลของ PickingPointItems
     * Create Date : 25/01/2017
     * By : Taninut.Bm
     */

    public static function GetPickingPointItems($pickingId) {
        $query = \common\models\costfit\PickingPointItems::find()
                ->where("picking_point_items.pickingId = '" . $pickingId . "'");
        return $query;
    }

    /* actionScanBag */

    public static function GetPickingPointItemsParameters($pickingId, $code) {
        $listPointItems = \common\models\costfit\PickingPointItems::find()->where("pickingId = '" . $pickingId . "' and  code = '" . $code . "' ")->one();
        return $listPointItems;
    }

    /*
     * Check ว่า BagNo. นี้ มีอยู่ใน Lockers และช่องนี้ยัง
     * End Check ว่า BagNo. นี้ มีอยู่ใน Lockers และช่องนี้ยั
     * Create Date : 25/01/2017
     * By : Taninut.Bm
     */

    public static function GetOrderItemPackingCheckLockersBagNo($bagNo, $boxcode) {
        $queryOrderItemPackingId = \common\models\costfit\OrderItemPacking::find()
                        ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, '
                                . 'order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,'
                                . 'count(order_item_packing.quantity) AS NumberOfQuantity , `order`.orderNo, `order`.orderId , `order`.pickingId')
                        ->joinWith(['orderItems'])
                        ->join('LEFT JOIN', 'order', 'order_item.orderId = `order`.orderId')
                        ->where("(order_item_packing.status = '" . \common\models\costfit\OrderItemPacking::PACKING_SENDING_PACKING_SHIPPING . "' "
                                . " and order_item_packing.bagNo ='" . $bagNo . "' and order_item.pickingId = '" . $boxcode . "' ) "
                                . " or ( order_item_packing.status = '" . \common\models\costfit\OrderItemPacking::PACKING_STATUS_EXPORT_TO_LOCKERS . "'  "
                                . " and order_item_packing.bagNo ='" . $bagNo . "' and `order`.pickingId = '" . $boxcode . "' ) "
//        . " and order_item.receiveType = '1'"
                                . "")
                        ->groupBy(['order_item_packing.bagNo'])->one();
        return $queryOrderItemPackingId;
    }

    public static function GetOrderItemPackingCheckLockersBagNoNew($bagNo, $boxcode) {
        $queryOrderItemPackingId = \common\models\costfit\OrderItemPacking::find()
                        ->where("order_item_packing.status = '" . \common\models\costfit\OrderItemPacking::PACKING_SENDING_PACKING_SHIPPING . "' "
                                . " and order_item_packing.bagNo ='" . $bagNo . "'  "
                                //. " or order_item_packing.status = '" . \common\models\costfit\OrderItemPacking::PACKING_STATUS_EXPORT_TO_LOCKERS . "'  "
                                //. " and order_item_packing.bagNo ='" . $bagNo . "' and order.pickingId = '" . $boxcode . "'  "
                                //. " and order_item.receiveType = '1'"
                                . "")
                        ->groupBy(['order_item_packing.bagNo'])->one();
        return $queryOrderItemPackingId;
    }

    public static function getQueryToViewScanBagNo($bagNo) {
        $query = \common\models\costfit\OrderItemPacking::find()
                ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, '
                        . 'order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,count(order_item_packing.quantity) AS NumberOfQuantity, '
                        . 'order.orderNo, '
                        . 'order.orderId,order_item_packing.quantity')
                ->joinWith(['orderItems'])
                ->join(' LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                ->where(" order_item_packing.status = '" . \common\models\costfit\OrderItemPacking::PACKING_SENDING_PACKING_SHIPPING . "' "
                        . " and order_item_packing.bagNo ='" . $bagNo . "' and order_item.receiveType = '1'")
                ->groupBy(['order_item_packing.bagNo']);
        return $query;
    }

    public static function getQueryCountBag($bagNo) {
        $queryCountBag = \common\models\costfit\OrderItemPacking::find()
                        ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, '
                                . 'order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,count(order_item_packing.quantity) AS NumberOfQuantity, '
                                . 'order.orderNo, '
                                . 'order.orderId,order_item_packing.quantity')
                        ->joinWith(['orderItems'])
                        ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                        ->where("order_item_packing.status = '" . \common\models\costfit\OrderItemPacking::PACKING_SENDING_PACKING_SHIPPING . "'"
                                . "  and order_item_packing.bagNo ='" . $bagNo . "' and order_item.receiveType = '1'")
                        ->groupBy(['order_item_packing.bagNo'])->one();
        return $queryCountBag;
    }

    public static function GetCountBag($orderId) {
        $countBag = \common\models\costfit\OrderItemPacking::find()
                ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, order_item_packing.status')
                ->joinWith(['orderItems'])
                ->where("order_item.orderId = '" . $orderId . "' and order_item_packing.status = '" . \common\models\costfit\OrderItemPacking::PACKING_SENDING_PACKING_SHIPPING . "' and order_item.receiveType = '1'")
                ->groupBy(['order_item_packing.bagNo'])
                ->count();
        return $countBag;
    }

    public static function GetOrderItemPacking($orderItemPackingId) {
        $OrderItemPacking = \common\models\costfit\OrderItemPacking::find()->where(" orderItemPackingId = '" . $orderItemPackingId . "'")->one();
        return $OrderItemPacking;
    }

    public static function GetPickingPointItemsPickingItems($boxcode, $channel, $pickingItemsId) {
        $listPointItems = \common\models\costfit\PickingPointItems::find()->where("pickingId = '" . $boxcode . "' and  "
                        . "code = '" . $channel . "' and pickingItemsId  = '" . $pickingItemsId . "' ")->one();
        return $listPointItems;
    }

    /*
      Query ส่วนของแสดง Order ของถุงนี้ที่ ใส่เข้าช่องของ Lockers นี้แล้ว
     */

    public static function GetOrderNoToBagNoOnChannelToLockers($orderItemId, $pickingItemsId, $bagNo) {
        //throw new \yii\base\Exception('orderItemId=> ' . $orderItemId . 'pickingItemId => ' . $pickingItemsId . 'bagNo =>' . $bagNo);
        $query1 = \common\models\costfit\OrderItemPacking::find()
                ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.pickingItemsId, '
                        . 'order_item_packing.bagNo, order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,'
                        . 'count(order_item_packing.quantity) AS NumberOfQuantity, order.orderNo, '
                        . 'order.orderId ,order_item_packing.quantity')
                ->joinWith(['orderItems'])
                ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                ->where("order_item_packing.status in (7,8) and  order_item.orderItemId ='" . $orderItemId . "' and order_item_packing.pickingItemsId = '" . $pickingItemsId . "'or order_item_packing.status in (7,8) "
                        . "and  order_item_packing.bagNo ='" . $bagNo . "' and order_item_packing.pickingItemsId = '" . $pickingItemsId . "'  and order_item.receiveType = '1'")
                ->groupBy(['order_item_packing.bagNo']);
        return $query1;
    }

    /* แสดงจำนวนถุงของ Order นี้ทั้งหมด */

    public static function GetOrderNoToBagNoOnChannelToLockersAll($orderId) {
        $queryAllOrder = \common\models\costfit\OrderItemPacking::find()
                ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, '
                        . 'order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,count(order_item_packing.quantity) AS NumberOfQuantity, '
                        . 'order.orderNo, '
                        . 'order.orderId,order_item_packing.quantity')
                ->joinWith(['orderItems'])
                ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                ->where("order_item_packing.status = 5 and order.orderId ='" . $orderId . "'  and order_item.receiveType = '1'")
                ->groupBy(['order_item_packing.bagNo']);
        return $queryAllOrder;
    }

    /* แสดง BagNo ที่ Scan Qr code */

    public static function GetBagNo($orderItemId) {
        //throw new \yii\base\Exception($orderItemId);
        $query1 = \common\models\costfit\OrderItemPacking::find()
                ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId,  order_item_packing.pickingItemsId,'
                        . 'order_item_packing.bagNo, order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,'
                        . 'count(order_item_packing.quantity) AS NumberOfQuantity, order.orderNo, '
                        . 'order.orderId ,order_item_packing.quantity')
                ->joinWith(['orderItems'])
                ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                ->where("order_item_packing.status in (7,8) and  order_item_packing.orderItemId ='" . $orderItemId . "'  and order_item.receiveType = '1'")
//->where("order_item_packing.status = 5 and order_item_packing.bagNo ='" . $bagNo . "' ")
                ->groupBy(['order_item_packing.bagNo']);
        return $query1;
    }

    public static function GetOrderItemPackingGetOrderItem($orderId) {
        $query = \common\models\costfit\OrderItemPacking::find()
                ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, order_item_packing.status')
                ->joinWith(['orderItems'])
                ->where("order_item.orderId = '" . $orderId . "' and order_item_packing.status = 5  and order_item.receiveType = '1'");
        return $query;
    }

    public static function GetOrderNoToBagNoOnChannelToLockersAllCheckParaBagNo($orderId) {
        $queryAllOrder = \common\models\costfit\OrderItemPacking::find()
                ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, '
                        . 'order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,count(order_item_packing.quantity) AS NumberOfQuantity, '
                        . 'order.orderNo, '
                        . 'order.orderId,order_item_packing.quantity')
                ->joinWith(['orderItems'])
                ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                ->where("order_item_packing.status = 5 and order.orderId ='" . $orderId . "'  and order_item.receiveType = '1'")
                ->groupBy(['order_item_packing.bagNo']);
        return $queryAllOrder;
    }

    /* actionCloseChannel */


    /* actionReturnBag */
}
