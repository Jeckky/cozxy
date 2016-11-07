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
class OrderItem extends \common\models\costfit\master\OrderItemMaster
{

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
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'maxDate',
            'sumQuantity',
            'remainDay',
            'storeProductId',
            'stockQuantity'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    public function getShippingType()
    {
        return $this->hasOne(ShippingType::className(), ['shippingTypeId' => 'sendDate']);
    }

    public static function findSlowestDate($orderId)
    {
        $model = OrderItem::find()
        ->select("MAX(st.date) as maxDate")
        ->join("LEFT JOIN", 'shipping_type st', 'st.shippingTypeId = order_item.sendDate')
        ->where('order_item.orderId=' . $orderId)
        ->one();

        return isset($model->maxDate) ? $model->maxDate : NULL;
    }

    public static function countPickingItemsArray($orderId)
    {
        $res = [];
        $query = \common\models\costfit\OrderItem::find()
        ->where("DATE(DATE_SUB(sendDateTime,INTERVAL " . \common\models\costfit\OrderItem::DATE_GAP_TO_PICKING . " DAY)) <= CURDATE() and orderId=" . $orderId)
        ->all();

        $res['countItems'] = count($query);
        $sumQuantity = 0;
        foreach ($query as $item) {
            $sumQuantity+=$item->quantity;
        }
        $res['sumQuantity'] = $sumQuantity;

        return $res;
    }

    public static function findOrderItems($orderId, $productId)
    {
        $items = OrderItem::find()->where("orderId=" . $orderId . " and productId=" . $productId)->one();
        if (isset($items)) {
            return $items;
        } else {
            return '';
        }
    }

}
