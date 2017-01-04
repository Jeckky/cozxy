<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderGroupHistoryMaster;

/**
* This is the model class for table "order_group_history".
*
    * @property string $orderGroupHistoryId
    * @property string $orderGroupId
    * @property string $decision
    * @property string $description
    * @property string $reasonCode
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class OrderGroupHistory extends \common\models\costfit\master\OrderGroupHistoryMaster{
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
