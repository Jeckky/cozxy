<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PickingPointItemsMaster;

/**
 * This is the model class for table "picking_point_items".
 *
 * @property string $pickingItemsId

 * @property integer $pickingId
 * @property string $name

 */
class PickingPointItems extends \common\models\costfit\master\PickingPointItemsMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getPickingPoint() {
        return $this->hasOne(PickingPoint::className(), ['pickingId' => 'pickingId']);
    }

    static function PickingPointDistinct($pickingItemId) {
        $result = OrderItemPacking::find()->where("pickingItemsId  =" . $pickingItemId . ' and status = 8 ')->one();
        if (count($result) > 0) {
            $result = FALSE; // มี pickingItemId แล้ว
        } else {
            $result = OrderItemPacking::find()->where("pickingItemsId  =" . $pickingItemId . ' and status < 8 ')->one();
            if (count($result) > 0) {
                $result = TRUE; // มี pickingItemId แล้ว
            } else {
                $result = FALSE; // มี pickingItemId แล้ว
            }
            //$result = TRUE; // มี pickingItemId แล้ว
        }
        // if ($result['status'] == 8) {
        //$result = TRUE; // มี pickingItemId แล้ว
        //} else {
        //$result = FALSE; // มี pickingItemId แล้ว
        // }
        /*
          if (count($result) > 0) {
          $result = TRUE; // มี pickingItemId แล้ว
          } else {
          $result = FALSE; // มี pickingItemId แล้ว
          }
         * */
        return $result;
    }

    static function PickingPointDistinctCount($pickingItemId) {
        $result = OrderItemPacking::find()->where("pickingItemsId  =" . $pickingItemId)->count();

        return $result;
    }

    public static function OrderId($pickingItemId) {
        $orderItemPacking = OrderItemPacking::find()->where("pickingItemsId=" . $pickingItemId . " and status=7")->one();
        if (isset($orderItemPacking) && !empty($orderItemPacking)) {
            $orderItem = OrderItem::find()->where("orderItemId=" . $orderItemPacking->orderItemId)->one();
            if (isset($orderItem) && !empty($orderItem)) {
                $order = Order::find()->where("orderId=" . $orderItem->orderId)->one();
                if (isset($order) && !empty($order)) {
                    return $order->orderNo;
                } else {
                    return '';
                }
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function bagNo($pickingItemId) {
        $bagNo = '';
        $bagNox = '';
        $orderItemPacking = OrderItemPacking::find()
                ->select('order_item_packing.bagNo, count(order_item_packing.bagNo) AS NumberOfBagNo ,order_item_packing.pickingItemsId')
                ->where("pickingItemsId=" . $pickingItemId . " and status=7")
                ->groupBy(['order_item_packing.bagNo'])
                ->all(); //เชค สถานะนำจ่าย(ลูกค้ายังไม่รับของ)
        if (count($orderItemPacking) > 0) {
            foreach ($orderItemPacking as $item):
                if ($item->bagNo != '') {
                    $bagNo .= $item->bagNo . "<br>";
                }$bagNox = $bagNo . $item->bagNo;
            endforeach;
        }
        return substr($bagNo, 0, -4);
    }

    public static function OrderNoChannels($pickingItemsId) {
        $OrderNo = '';
        $orderItemPacking = OrderItemPacking::find()
                ->select('order_item_packing.bagNo, count(order_item_packing.bagNo) AS NumberOfBagNo ,order_item_packing.pickingItemsId')
                ->where("pickingItemsId=" . $pickingItemsId . " and status=7")
                ->groupBy(['order_item_packing.bagNo'])
                ->all(); //เชค สถานะนำจ่าย(ลูกค้ายังไม่รับของ)
        if (count($orderItemPacking) > 0) {
            foreach ($orderItemPacking as $item):
                //$bagNo = substr($item->bagNo, 0, -2);
                $OrderNo .= "'" . $item->bagNo . "',";
                //$bagNox = $bagNo . $item->bagNo;
            endforeach;
        }

        return substr($OrderNo, 0, -1);
    }

    public static function OrderNoList($bagNo) {
        $queryOrderItemPackingId = \common\models\costfit\OrderItemPacking::find()
                        ->select('`order_item_packing`.`orderItemPackingId`, `order_item_packing`.`orderItemId`,'
                                . '`order_item_packing`.`bagNo`, `order_item_packing`.`status`,`order`.`orderNo`, `order`.`orderId` ,`order`.`orderNo` ')
                        ->joinWith(['orderItems'])
                        ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                        ->where("order_item_packing.status = 7 and order_item_packing.bagNo in (" . $bagNo . ")")
                        ->groupBy(['`order`.`orderNo` '])->one();
        if (count($queryOrderItemPackingId) > 0) {
            return $queryOrderItemPackingId->orderNo;
        } else {
            return '';
        }
    }

}
