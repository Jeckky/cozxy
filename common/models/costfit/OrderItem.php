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
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

}
