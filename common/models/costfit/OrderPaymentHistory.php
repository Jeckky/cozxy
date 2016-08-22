<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderPaymentHistoryMaster;

/**
* This is the model class for table "order_payment_history".
*
    * @property string $orderPaymentHistoryId
    * @property string $orderId
    * @property string $decision
    * @property string $reasonCode
    * @property string $reason
    * @property string $userIp
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class OrderPaymentHistory extends \common\models\costfit\master\OrderPaymentHistoryMaster{
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
