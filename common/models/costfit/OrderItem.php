<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderItemMaster;

/**
 * This is the model class for table "order_item".
 *
 * @property string $orderItemId
 * @property string $orderId
 * @property string $productId
 * @property string $quantity
 * @property string $price
 * @property string $total
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property Order $order
 * @property Product $product
 */
class OrderItem extends \common\models\costfit\master\OrderItemMaster {

    const DATE_GAP_TO_PICKING = 2;
    const ORDERITEM_PICKING = 4;
    const ORDERITEM_PICKED = 5;
    const ORDERITEM_PICKED_BAGNO = 6;
    const ORDER_STATUS_SENDING_SHIPPING = 14;
    //
    //Param For Report
    const FUTURE_DAY_TO_SHOW = 7;

    //Param For Report

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'maxDate',
            'sumQuantity',
            'remainDay',
            'storeProductId',
            'stockQuantity', 'conutProduct', 'summaryPrice', 'avgNum', 'quantitySuppliers', 'quantityBalance'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getProduct() {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    public function getProductSupplier() {
        return $this->hasOne(\common\models\costfit\ProductSuppliers::className(), ['productSuppId' => 'productSuppId']);
    }

    public function getShippingType() {
        return $this->hasOne(ShippingType::className(), ['shippingTypeId' => 'sendDate']);
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['userId' => 'supplierId']);
    }

    public static function findSlowestDate($orderId) {
        $model = OrderItem::find()
        ->select("MAX(st.date) as maxDate")
        ->join("LEFT JOIN", 'shipping_type st', 'st.shippingTypeId = order_item.sendDate')
        ->where('order_item.orderId=' . $orderId)
        ->one();

        return isset($model->maxDate) ? $model->maxDate : NULL;
    }

    public static function countPickingItemsArray($orderId) {
        $res = [];
        $query = \common\models\costfit\OrderItem::find()
        ->where("orderId=" . $orderId)
        ->all();

        $res['countItems'] = count($query);
        $sumQuantity = 0;
        foreach ($query as $item) {
            $sumQuantity += $item->quantity;
        }
        $res['sumQuantity'] = $sumQuantity;

        return $res;
    }

    public static function findOrderItems($orderId, $productId) {
        //$items = OrderItem::find()->where("orderId=" . $orderId . " and productId=" . $productId . " and status<=5")->one();
        $items = OrderItem::find()->where("orderId=" . $orderId . " and productSuppId=" . $productId . " and status<=5")->one();
        if (isset($items)) {
            return $items;
        } else {
            return '';
        }
    }

    public static function findAllItems($orderId) {
        //$items = OrderItem::find()->where("orderId=" . $orderId . " and productId=" . $productId . " and status<=5")->one();
        $items = OrderItem::find()->where("orderId=" . $orderId)->all();
        if (isset($items)) {
            return $items;
        } else {
            return '';
        }
    }

    public static function creteStatus($orderId) {
        $totalPicked = 0;
        $total2 = 0;
        $items = OrderItem::find()->where("orderId=" . $orderId . " and status!=1")->all();
        $picked = count($items);
        if (isset($items) && !empty($items)) {
            foreach ($items as $item):
                $totalPicked += $item->quantity;
            endforeach;
        }
        $items2 = OrderItem::find()->where("orderId=" . $orderId . " and status=1")->all();
        $ready = count($items2);
        if (isset($items2) && !empty($items2)) {
            foreach ($items2 as $item2):
                $total2 += $item2->quantity;
            endforeach;
        }
        $text = 'ส่งแล้ว ' . $picked . ' รายการ ' . $totalPicked . ' ชิ้น<br> ยังไม่หยิบ ' . $ready . ' รายการ ' . $total2 . ' ชิ้น';
        return $text;
    }

    public static function supplierItems($supplierId, $orderIds) {
        $orderId = '';
        $productId = [];
        $i = 0;
        foreach ($orderIds as $order):
            $orderId = $orderId . $order . ",";
        endforeach;
        $orderId = substr($orderId, 0, -1);
        $orderItem = OrderItem::find()->where("orderId in (" . $orderId . ") and supplierId=" . $supplierId)->all();
        if (isset($orderItem) && !empty($orderItem)) {
            foreach ($orderItem as $item):
                $flag = false;
                $check = 0;
                foreach ($productId as $id):
                    if ($id == $item->productSuppId) {
                        $check++;
                    }
                endforeach;
                if ($check == 0) {
                    $flag = true;
                }
                if ($flag == true) {
                    $productId[$i] = $item->productSuppId; // ได้ productId ที่ไม่ซ้ำกัน
                    $i++;
                }
            endforeach;
        }
        return $productId;
    }

    public static function totalSupplierItem($supplierId, $productSuppId, $orders) {
        $orderId = '';
        $total = 0;
        foreach ($orders as $order):
            $orderId = $orderId . $order . ",";
        endforeach;
        $orderId = substr($orderId, 0, -1);
        $orderItems = OrderItem::find()->where("orderId in (" . $orderId . ") and supplierId=" . $supplierId . " and productSuppId=" . $productSuppId)->all();
        if (isset($orderItems) && !empty($orderItems)) {
            foreach ($orderItems as $orderItem):
                $total += $orderItem->quantity;
            endforeach;
        }
        return $total;
    }

    public static function summarySupplier($supplierId, $orders) {
        $orderId = '';
        $i = 0;
        $summary = 0;
        foreach ($orders as $order):
            $orderId = $orderId . $order . ",";
        endforeach;
        $orderId = substr($orderId, 0, -1);
        $orderItem = OrderItem::find()->where("orderId in (" . $orderId . ") and supplierId=" . $supplierId)->all();
        if (isset($orderItem) && !empty($orderItem)) {
            foreach ($orderItem as $item):
                $price = ProductSuppliers::productPriceSupplier($item->productSuppId);
                $amount = $price * $item->quantity;
                $summary += $amount;
            endforeach;
        }
        return $summary;
    }

    public static function enoughtProductSupp($order) {
        $notEnough = '';
        $orderItems = OrderItem::find()->where("orderId=" . $order->orderId)->all();
        foreach ($orderItems as $item):
            $productSupp = ProductSuppliers::find()->where("productSuppId=" . $item->productSuppId)->one();
            // throw new \yii\base\Exception($productSupp->result . "<" . $item->quantity);
            if ($productSupp->result < $item->quantity) {//product ใน stock  มีพอหรือไม่
                $notEnough = $notEnough . $productSupp->productSuppId . ",";
            }
        endforeach;
        if ($notEnough != '') {
            $notEnough = substr($notEnough, 0, -1);
            return $notEnough;
        } else {
            return $notEnough;
        }
    }

    public static function itemNotEnought($orderId, $id) {
        $orderItems = OrderItem::find()->where("orderId=" . $orderId . " and productsuppId in ($id)")->all();
        return $orderItems;
    }

    public static function calculateReturnDiscount($orderItemId) {
        $orderItem = OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
        $discount = 0;
        if (isset($orderItem) && !empty($orderItem)) {
            $discount = $orderItem->discountValue / $orderItem->quantity;
        }
        return $discount;
    }

}
