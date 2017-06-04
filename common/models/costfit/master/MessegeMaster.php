<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "messege".
*
    * @property string $messegeId
    * @property integer $ticketId
    * @property integer $orderId
    * @property integer $userId
    * @property string $message
    * @property integer $messegeType
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
            [['ticketId', 'orderId', 'userId', 'message', 'messegeType'], 'required'],
            [['ticketId', 'orderId', 'userId', 'messegeType', 'status'], 'integer'],
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
    'messegeId' => Yii::t('messege', 'Messege ID'),
    'ticketId' => Yii::t('messege', 'Ticket ID'),
    'orderId' => Yii::t('messege', 'Order ID'),
    'userId' => Yii::t('messege', 'User ID'),
    'message' => Yii::t('messege', 'Message'),
    'messegeType' => Yii::t('messege', 'Messege Type'),
    'status' => Yii::t('messege', 'Status'),
    'createDateTime' => Yii::t('messege', 'Create Date Time'),
    'updateDateTime' => Yii::t('messege', 'Update Date Time'),
];
}
}
