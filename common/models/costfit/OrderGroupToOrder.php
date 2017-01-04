<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderGroupToOrderMaster;

/**
* This is the model class for table "order_group_to_order".
*
    * @property string $id
    * @property string $orderGroupId
    * @property string $orderId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class OrderGroupToOrder extends \common\models\costfit\master\OrderGroupToOrderMaster{
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
