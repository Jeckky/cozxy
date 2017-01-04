<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderDetailMaster;

/**
* This is the model class for table "order_detail".
*
    * @property string $orderDetailId
    * @property string $orderDetailTemplateId
    * @property string $orderId
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class OrderDetail extends \common\models\costfit\master\OrderDetailMaster{
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
