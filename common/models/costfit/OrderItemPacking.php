<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderItemPackingMaster;

/**

 * This is the model class for table "order_item_packing".
 *
 * @property integer $orderItemPackingId
 * @property integer $orderItemId
 * @property integer $bagNo
 * @property string $quantity
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class OrderItemPacking extends \common\models\costfit\master\OrderItemPackingMaster {

    const ORDER_STATUS_CLOSE_BAG = 4; //กำลังจัดส่ง
    const ORDER_STATUS_SENDING_PACKING_SHIPPING = 5; //กำลังจัดส่ง

    /* Customize Date 25/01/2017 , By Taninut.Bm */
    /*
     * status
      - 4  : ปิดถุงแล้ว
      - 5  : กำลังจัดส่ง
      - 99 : กำลัง pack
      - 7  : นำจ่าย
      - 8  : ลูกค้ารับของแล้ว
      - 9  : ตรวจช่อง OK
      - 10 : ตรวจช่อง No
     */
    const PACKING_STATUS_CLOSE_BAG = 4;
    const PACKING_SENDING_PACKING_SHIPPING = 5;
    const PACKING_STATUS_BEING_PACK = 99;
    const PACKING_STATUS_EXPORT_TO_LOCKERS = 7;
    const PACKING_STATUS_CUSTOMERS_RECEIVE = 8;
    const PACKING_STATUS_CHECK_CHANNEL_OK = 9;
    const PACKING_STATUS_CHECK_CHANNEL_NO = 10;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'bagNo',
            'status',
            'orderId',
            'NumberOfBagNo',
            'orderNo',
            'NumberOfQuantity',
            'pickingId',
            'NumberOfDate',
            'DateOfPut',
            'DateOfReceive'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
        ]);
    }

    static public function orderInPacking($orderId) {
        $orderItems = OrderItem::find()->where("orderId=" . $orderId)->all();
//throw new \yii\base\Exception(print_r($orderItems, true));
        $itemItemId = '';
        foreach ($orderItems as $orderItem):
            $itemItemId = $itemItemId . $orderItem->orderItemId . ",";
        endforeach;
        if (!empty($itemItemId) && isset($itemItemId)) {
            $itemItemId = substr($itemItemId, 0, -1);
//throw new \yii\base\Exception($itemItemId);
            $orderItemPackings = OrderItemPacking::find()->where("orderItemId in ($itemItemId) and status =99")->all();
            if (isset($orderItemPackings) && !empty($orderItemPackings)) {
//throw new \yii\base\Exception(print_r($itemItemId, true));
                return $orderItemPackings;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    static public function itemInBag($bagNo) {
        $items = '';
        $bags = OrderItemPacking::find()->where("bagNo='" . $bagNo . "'")->all();
        $oldBag = '';
        if (isset($bags) && !empty($bags)) {
            foreach ($bags as $bag):
                if ($bag->bagNo != $oldBag) {
                    $itemsInBag = OrderItemPacking::find()->where("bagNo='" . $bag->bagNo . "'")->all();
                    if (isset($itemsInBag) && !empty($itemsInBag)) {
                        foreach ($itemsInBag as $itemInBag):
                            $orderItem = OrderItem::find()->where("orderItemId=" . $itemInBag->orderItemId)->one();
                            if (isset($orderItem) && !empty($orderItem)) {
                                $product = Product::find()->where("productId=" . $orderItem->productId)->one();
                                if (isset($product) && !empty($product)) {
                                    $items = $items . $product->code . " (" . $bag->quantity . ")" . ", ";
                                }
                            }
                        endforeach;
                    }
                    $oldBag = $bag->bagNo;
                }
            endforeach;
//throw new \yii\base\Exception($items);
            $items = substr($items, 0, -2);
            return $items;
        } else {
            return '';
        }
    }

    static public function createStatus($orderItemId) {
        $result = 0;
        $totalInPacking = 0;
        $allQuantity = OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
        if (isset($allQuantity) && !empty($allQuantity)) {
            $resultInPacking = OrderItemPacking::find()->where("orderItemId=" . $orderItemId . " and status=4")->all();
            if (isset($resultInPacking) && !empty($resultInPacking)) {
                foreach ($resultInPacking as $resultIn):
                    $totalInPacking += $resultIn->quantity;
                endforeach;
            }
            $result = $allQuantity->quantity - $totalInPacking;
        }
        return $result;
    }

    static public function shipPacking($orderItemId) {

        $orderItem = OrderItem::find()
                        ->where("orderItemId=" . $orderItemId)->one();
//throw new \yii\base\Exception($orderItem->order->status);
        if ($orderItem->status == 13) {
            $status = 4;
        } else {
            $status = 5;
        }

        $result = OrderItemPacking::find()
//->distinct('order_item_packing.bagNo')
                ->join('LEFT JOIN', 'order_item oi', 'oi.orderItemId = order_item_packing.orderItemId')
                ->where(['oi.orderId' => $orderItem->orderId, 'order_item_packing.status' => $status])
                ->count();
//throw new \yii\base\Exception($orderItemId);
        return $result;
    }

    static public function findItemInBag($bagNo) {
        $orderItems = OrderItemPacking::find()->where("bagNo='" . $bagNo . "' and status=4")->all();
        if (isset($orderItems) && !empty($orderItems)) {
            return $orderItems;
        } else {
            return '';
        }
    }

    public function getOrderItems() {
        return $this->hasMany(OrderItem::className(), ['orderItemId' => 'orderItemId']); //[Order :: ปลายทาง ,  OrderItem :: ต้นทาง]
    }

    public function getPickingPoint() {
        return $this->hasOne(PickingPoint::className(), ['pickingId' => 'pickingId']); //[Order :: ปลายทาง ,  OrderItem :: ต้นทาง]
    }

    static public function countBagNo($bagNo) {
        $result = OrderItemPacking::find()
//->distinct('order_item_packing.bagNo')
//->join('LEFT JOIN', 'order_item oi', 'oi.orderItemId = order_item_packing.orderItemId')
                ->where(['order_item_packing.bagNo' => $bagNo])
                ->count();
        return $result;
    }

    static public function countQuantity($bagNo) {
        $result = OrderItemPacking::find()
                ->where(['order_item_packing.bagNo' => $bagNo])
                ->sum('order_item_packing.quantity');
        return $result;
    }

    static public function checkBagNo($pickingItemsId) {
        /*
          $queryOrderItemPackingId = \common\models\costfit\OrderItemPacking::find()
          ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, '
          . 'order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,count(order_item_packing.quantity) AS NumberOfQuantity , order.orderNo, order.orderId')
          ->joinWith(['orderItems'])
          ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
          ->where("order_item_packing.statusc = 7 and order_item_packing.bagNo ='" . $bagNo . "'   and pickingItemsId is not null")
          ->groupBy(['order_item_packing.bagNo'])->one();

          $queryOrderItemPackingId = \common\models\costfit\OrderItemPacking::find()
          ->where("order_item_packing.status = 7 and order_item_packing.bagNo ='" . $bagNo . "' and pickingItemsId= '" . $pickingItemsId . "' ")
          ->groupBy(['order_item_packing.bagNo'])->one(); */

        $queryOrderItemPackingId = \common\models\costfit\PickingPointItems::find()
                        ->where("pickingItemsId= '" . $pickingItemsId . "' ")->one();
        if (count($queryOrderItemPackingId) == 0) {
            return $queryOrderItemPackingId['pickingItemsId']; // yes
        } else {
            return $queryOrderItemPackingId['pickingItemsId']; // no
        }
    }

    static public function checkInspector($pickingItemsId) {
        $result = OrderItemPacking::find()
                ->select('curdate(),date(shipdate) , (curdate() - date(shipdate)) AS DateOfPut , (date(updateDateTime) - date(shipdate)) AS DateOfReceive  , status ,remark ')
                ->where(['order_item_packing.pickingItemsId' => $pickingItemsId])
                ->one();
        return $result;
    }

    public static function findOrderAtPoint($pickingPointId) {
        $items = OrderItemPacking::find()->where("shipper=" . Yii::$app->user->identity->userId . " and status=" . OrderItemPacking::ORDER_STATUS_SENDING_PACKING_SHIPPING)->all();

        $orderId = [];
        if (isset($items) && !empty($items)) {
            $i = 0;
            foreach ($items as $item):
                $check = 0;
                $orderItem = OrderItem::find()->where("orderItemId=" . $item->orderItemId)->one();
                foreach ($orderId as $old):
                    if ($old == $orderItem->orderId) {
                        $check++;
                    }
                endforeach;
                if ($check == 0) {
                    $order = Order::find()->where("orderId=" . $orderItem->orderId)->one();
                    if ($order->pickingId == $pickingPointId) {
                        $orderId[$i] = $orderItem->orderId;
                        $i++;
                    }
                }
            endforeach;
            return $orderId;
        } else {
            return '';
        }
    }

    public static function findBagNo($orderItemId) {
        $oldBag = [];
        $orderItemId = OrderItemPacking::find()->where("orderItemId in ($orderItemId) and status=" . OrderItemPacking::ORDER_STATUS_SENDING_PACKING_SHIPPING)->all();
        if (isset($orderItemId) && count($orderItemId) > 0) {
            $i = 0;
            foreach ($orderItemId as $item):
                $flag = OrderItemPacking::checkBag($oldBag, $item->bagNo);
                if ($flag == true) {
                    $oldBag[$i] = $item->bagNo;
                    $i++;
                }
            endforeach;
            return $oldBag;
        } else {
            return '';
        }
    }

    public static function countBagAtPoint($pickingPoint) {
        $items = OrderItemPacking::find()->where("shipper=" . Yii::$app->user->identity->userId . " and status=" . OrderItemPacking::ORDER_STATUS_SENDING_PACKING_SHIPPING)->all();
        $orderId = [];
        $orderIds = '';
        $orderItemBag = '';
        $oldBag = [];
        if (isset($items) && !empty($items)) {
            $i = 0;
            foreach ($items as $item):
                $check = 0;
                $orderItem = OrderItem::find()->where("orderItemId=" . $item->orderItemId)->one();
                foreach ($orderId as $old):
                    if ($old == $orderItem->orderId) {
                        $check++;
                    }
                endforeach;
                if ($check == 0) {
                    $order = Order::find()->where("orderId=" . $orderItem->orderId)->one();
                    if ($order->pickingId == $pickingPoint) {
                        $orderId[$i] = $order->orderId;
                        $orderIds .= $orderItem->orderId . ",";
                    }
                }
            endforeach;
            if ($orderIds != '') {
                $orderIds = substr($orderIds, 0, -1);
            }
            $orderItems = OrderItem::find()->where("orderId in ($orderIds)")->all();
            foreach ($orderItems as $item) :
                $orderItemBag .= $item->orderItemId . ",";
            endforeach;
            $orderItemBag = substr($orderItemBag, 0, -1);
            $bags = OrderItemPacking::find()->where("orderItemId in ($orderItemBag) and shipper=" . Yii::$app->user->identity->userId . " and status=" . OrderItemPacking::ORDER_STATUS_SENDING_PACKING_SHIPPING)->all();
            if (isset($bags) && count($bags) > 0) {
                $i = 0;
                foreach ($bags as $bag):
                    $flag = OrderItemPacking::checkBag($oldBag, $bag->bagNo);
                    if ($flag == true) {
                        $oldBag[$i] = $bag->bagNo;
                        $i++;
                    }
                endforeach;
                return count($oldBag);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function checkBag($olds, $new) {
        $i = 0;
        foreach ($olds as $old):
            if ($new == $old) {
                $i++;
            }
        endforeach;
        if ($i == 0) {
            return true;
        } else {
            return false;
        }
    }

}
