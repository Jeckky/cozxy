<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderItemPackingMaster;

/**
* This is the model class for table "order_item_packing".
*
    * @property string $orderItemPackingId
    * @property string $orderItemId
    * @property string $bagNo
    * @property string $quantity
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class OrderItemPacking extends \common\models\costfit\master\OrderItemPackingMaster{
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
