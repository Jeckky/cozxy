<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "messege".
*
    * @property string $messageId
    * @property string $ticketId
    * @property string $orderId
    * @property string $userId
    * @property string $message
    * @property integer $messageType
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class MessegeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'messege';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['ticketId', 'orderId', 'userId', 'message', 'messageType'], 'required'],
            [['ticketId', 'orderId', 'userId', 'messageType', 'status'], 'integer'],
            [['message'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'messageId' => Yii::t('messege', 'Message ID'),
    'ticketId' => Yii::t('messege', 'Ticket ID'),
    'orderId' => Yii::t('messege', 'Order ID'),
    'userId' => Yii::t('messege', 'User ID'),
    'message' => Yii::t('messege', 'Message'),
    'messageType' => Yii::t('messege', 'Message Type'),
    'status' => Yii::t('messege', 'Status'),
    'createDateTime' => Yii::t('messege', 'Create Date Time'),
    'updateDateTime' => Yii::t('messege', 'Update Date Time'),
];
}
}
