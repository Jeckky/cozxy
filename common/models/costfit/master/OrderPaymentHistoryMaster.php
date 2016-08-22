<?php

namespace common\models\costfit\master;

use Yii;

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
class OrderPaymentHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_payment_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderId', 'decision', 'reasonCode', 'reason', 'createDateTime'], 'required'],
            [['orderId', 'status'], 'integer'],
            [['reason'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['decision', 'reasonCode', 'userIp'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderPaymentHistoryId' => Yii::t('order_payment_history', 'Order Payment History ID'),
    'orderId' => Yii::t('order_payment_history', 'Order ID'),
    'decision' => Yii::t('order_payment_history', 'Decision'),
    'reasonCode' => Yii::t('order_payment_history', 'Reason Code'),
    'reason' => Yii::t('order_payment_history', 'Reason'),
    'userIp' => Yii::t('order_payment_history', 'User Ip'),
    'status' => Yii::t('order_payment_history', 'Status'),
    'createDateTime' => Yii::t('order_payment_history', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_payment_history', 'Update Date Time'),
];
}
}
