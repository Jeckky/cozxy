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

    static public function orderInPacking($orderId) {
        $orderItems = OrderItem::find()->where("orderId=" . $orderId)->all();
        $itemItemId = '';
        foreach ($orderItems as $orderItem):
            $itemItemId = $itemItemId . $orderItem->orderItemId . ",";
        endforeach;
        if (!empty($itemItemId)) {
            $itemItemId = substr($itemItemId, 0, -1);
            $orderItemPackings = OrderItemPacking::find()->where("orderItemId in ('" . $itemItemId . "') and status !=4")->all();
            if (isset($orderItemPackings) && !empty($orderItemPackings)) {
                return $orderItemPackings;
            } else {
                return '';
            }
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
                    $totalInPacking+=$resultIn->quantity;
                endforeach;
            }
            $result = $allQuantity->quantity - $totalInPacking;
        }
        return $result;
    }

    static public function shipPacking($orderItemId) {
        $result = OrderItemPacking::find()->where(['orderItemId' => $orderItemId, 'status' => 5])->count();
        return $result;
    }

    public function getOrderItems() {
        return $this->hasMany(OrderItem::className(), ['orderItemId' => 'orderItemId']); //[Order :: ปลายทาง ,  OrderItem :: ต้นทาง]
    }

}
