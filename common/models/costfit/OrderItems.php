<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderItemsMaster;

/**
* This is the model class for table "order_items".
*
    * @property string $orderItemsId
    * @property string $orderId
    * @property string $productId
    * @property string $title
    * @property string $price
    * @property string $quantity
    * @property string $total
    * @property string $groupName
    * @property string $area
    * @property string $productOptionId
    * @property string $styleId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class OrderItems extends \common\models\costfit\master\OrderItemsMaster{
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
