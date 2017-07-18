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
    * @property string $ticketNo
    * @property string $remark
    * @property integer $cozxyRemark
    * @property integer $provinceId
    * @property integer $amphurId
    * @property integer $pickingId
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
            [['orderId', 'userId', 'ticketNo', 'remark', 'cozxyRemark', 'provinceId', 'amphurId', 'pickingId'], 'required'],
            [['orderId', 'userId', 'cozxyRemark', 'provinceId', 'amphurId', 'pickingId', 'status'], 'integer'],
            [['description', 'remark'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'ticketNo'], 'string', 'max' => 255],
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
    'ticketNo' => Yii::t('ticket', 'Ticket No'),
    'remark' => Yii::t('ticket', 'Remark'),
    'cozxyRemark' => Yii::t('ticket', 'Cozxy Remark'),
    'provinceId' => Yii::t('ticket', 'Province ID'),
    'amphurId' => Yii::t('ticket', 'Amphur ID'),
    'pickingId' => Yii::t('ticket', 'Picking ID'),
    'status' => Yii::t('ticket', 'Status'),
    'createDateTime' => Yii::t('ticket', 'Create Date Time'),
    'updateDateTime' => Yii::t('ticket', 'Update Date Time'),
];
}
}
