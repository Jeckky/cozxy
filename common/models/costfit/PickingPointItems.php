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

    // Check Status 8 //
    public static function bagNo8($pickingItemId) {
        $bagNo = '';
        $bagNox = '';
        $orderItemPacking = OrderItemPacking::find()
        ->select('order_item_packing.bagNo, count(order_item_packing.bagNo) AS NumberOfBagNo ,order_item_packing.pickingItemsId')
        ->where("pickingItemsId=" . $pickingItemId . " and status >= 8")
        ->groupBy(['order_item_packing.bagNo'])
        ->all(); //เชค สถานะนำจ่าย(ลูกค้ายังไม่รับของ)
        if (count($orderItemPacking) > 0) {
            foreach ($orderItemPacking as $item):
                if ($item->bagNo != '') {
                    $bagNo .= $item->bagNo . ",";
                }$bagNox = $bagNo . $item->bagNo;
            endforeach;
        }
        return substr($bagNo, 0, -1);
    }

    public static function OrderNoChannels8($pickingItemsId) {
        $OrderNo = '';
        $orderItemPacking = OrderItemPacking::find()
        ->select('order_item_packing.bagNo, count(order_item_packing.bagNo) AS NumberOfBagNo ,order_item_packing.pickingItemsId')
        ->where("pickingItemsId=" . $pickingItemsId . " and status >= 8")
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

    public static function OrderNoList8($bagNo) {
        $queryOrderItemPackingId = \common\models\costfit\OrderItemPacking::find()
        ->select('`order_item_packing`.`orderItemPackingId`, `order_item_packing`.`orderItemId`,'
        . ' `order_item_packing`.`status`,`order_item_packing`.`remark`,`order_item_packing`.`updateDateTime`,'
        . '`order_item_packing`.`bagNo`, `order_item_packing`.`status`,`order`.`orderNo`, '
        . '`order`.`orderId` ,`order`.`orderNo` , (curdate() - date(`order_item_packing`.shipdate)) as NumberOfDate , '
        . '`order_item_packing`.`type` ,`order_item_packing`.lastvisitDate ')
        ->joinWith(['orderItems'])
        ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
        ->where("order_item_packing.status >= 8 and order_item_packing.bagNo in (" . $bagNo . ")")
        ->groupBy(['`order`.`orderNo` '])->one();
        if (count($queryOrderItemPackingId) > 0) {
            return $queryOrderItemPackingId; //$queryOrderItemPackingId->orderNo;
        } else {
            return '';
        }
    }

    public static function ChannelsInspector($pickingId) {
        /*
          SELECT  picking_point_items.pickingItemsId ,picking_point_items.pickingId ,picking_point_items.code ,picking_point_items.name
          ,(select order_item_packing.status from costfit_test.order_item_packing where order_item_packing.pickingItemsId = `picking_point_items`.pickingItemsId  limit 1) as  orderItemPackingStatus
          ,(select order_item_packing.BagNo from costfit_test.order_item_packing where order_item_packing.pickingItemsId = `picking_point_items`.pickingItemsId  limit 1) as  orderItemPackingBagNo
          FROM `picking_point_items`
          where `picking_point_items`.pickingId = 10 -- and (select order_item_packing.status from costfit_test.order_item_packing where order_item_packing.pickingItemsId = `picking_point_items`.pickingItemsId  limit 1)  > 8
          // Count ช่องที่มีการตรวจสอบแล้ว
          SELECT count(picking_point_items.pickingItemsId)
          FROM `picking_point_items`
          where `picking_point_items`.pickingId = 10  and (select order_item_packing.status from costfit_test.order_item_packing where order_item_packing.pickingItemsId = `picking_point_items`.pickingItemsId  limit 1)  > 8
         * */
        $CountChannelsInspector = \common\models\costfit\PickingPointItems::find()
        ->where("`picking_point_items`.pickingId = '" . $pickingId . "' "
        . " and (select order_item_packing.status from order_item_packing "
        . "where order_item_packing.pickingItemsId = `picking_point_items`.pickingItemsId  limit 1)  = 8")
        ->count();
        //if (count($CountChannelsInspector) > 0) {
        return $CountChannelsInspector; //$queryOrderItemPackingId->orderNo;
        //} else {
        // return '';
        // }
    }

    public static function NotChannelsInspector($pickingId) {
        /*
          SELECT  picking_point_items.pickingItemsId ,picking_point_items.pickingId ,picking_point_items.code ,picking_point_items.name
          ,(select order_item_packing.status from costfit_test.order_item_packing where order_item_packing.pickingItemsId = `picking_point_items`.pickingItemsId  limit 1) as  orderItemPackingStatus
          ,(select order_item_packing.BagNo from costfit_test.order_item_packing where order_item_packing.pickingItemsId = `picking_point_items`.pickingItemsId  limit 1) as  orderItemPackingBagNo
          FROM `picking_point_items`
          where `picking_point_items`.pickingId = 10 -- and (select order_item_packing.status from costfit_test.order_item_packing where order_item_packing.pickingItemsId = `picking_point_items`.pickingItemsId  limit 1)  > 8
          // Count ช่องที่มีการตรวจสอบแล้ว
          SELECT count(picking_point_items.pickingItemsId)
          FROM `picking_point_items`
          where `picking_point_items`.pickingId = 10  and (select order_item_packing.status from costfit_test.order_item_packing where order_item_packing.pickingItemsId = `picking_point_items`.pickingItemsId  limit 1)  > 8
         * */
        $CountChannelsInspector = \common\models\costfit\PickingPointItems::find()
        ->where("`picking_point_items`.pickingId = '" . $pickingId . "' "
        . " and (select order_item_packing.status from order_item_packing "
        . "where order_item_packing.pickingItemsId = `picking_point_items`.pickingItemsId  limit 1)  in(8) ") // in(8, 10)  ช่องที่ต้องตรวจสอบ
        ->one();
        //if (count($CountChannelsInspector) > 0) {
        return $CountChannelsInspector; //$queryOrderItemPackingId->orderNo;
        //} else {
        // return '';
        // }
    }

}
