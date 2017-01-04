<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderDetailValueMaster;

/**
* This is the model class for table "order_detail_value".
*
    * @property string $orderDetailValueId
    * @property string $orderDetailId
    * @property string $orderDetailTemplateFieldId
    * @property string $value
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class OrderDetailValue extends \common\models\costfit\master\OrderDetailValueMaster{
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
