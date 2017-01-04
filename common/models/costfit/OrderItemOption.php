<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderItemOptionMaster;

/**
* This is the model class for table "order_item_option".
*
    * @property string $orderItemOption
    * @property string $orderItemId
    * @property string $productOptionGroupId
    * @property string $productOptionId
    * @property string $value
    * @property string $percent
    * @property string $total
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class OrderItemOption extends \common\models\costfit\master\OrderItemOptionMaster{
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
