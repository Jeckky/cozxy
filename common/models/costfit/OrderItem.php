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
            'maxDate'
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

}
