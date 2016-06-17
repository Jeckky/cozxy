<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\StoreProductOrderItemMaster;

/**
* This is the model class for table "store_product_order_item".
*
* @property string $storeProductOrderItemId
* @property string $orderId
* @property string $productId
* @property string $storeProductId
* @property string $quantity
* @property string $price
* @property string $total
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*
* @property Product $product
* @property Order $order
* @property StoreProduct $storeProduct
*/

class StoreProductOrderItem extends \common\models\costfit\master\StoreProductOrderItemMaster{
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
}
