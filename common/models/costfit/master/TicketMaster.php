<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "ticket".
*
    * @property string $ticketId
    * @property integer $orderId
    * @property integer $userId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class TicketMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'ticket';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderId', 'userId', 'description'], 'required'],
            [['orderId', 'userId', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'ticketId' => Yii::t('ticket', 'Ticket ID'),
    'orderId' => Yii::t('ticket', 'Order ID'),
    'userId' => Yii::t('ticket', 'User ID'),
    'title' => Yii::t('ticket', 'Title'),
    'description' => Yii::t('ticket', 'Description'),
    'status' => Yii::t('ticket', 'Status'),
    'createDateTime' => Yii::t('ticket', 'Create Date Time'),
    'updateDateTime' => Yii::t('ticket', 'Update Date Time'),
];
}
}
