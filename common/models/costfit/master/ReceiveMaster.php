<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "receive".
*
    * @property integer $receiveId
    * @property integer $orderId
    * @property integer $userId
    * @property integer $pickingId
    * @property string $password
    * @property string $otp
    * @property string $refNo
    * @property integer $isUse
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ReceiveMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'receive';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderId', 'userId', 'pickingId', 'refNo'], 'required'],
            [['orderId', 'userId', 'pickingId', 'isUse', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['password', 'otp'], 'string', 'max' => 45],
            [['refNo'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'receiveId' => Yii::t('receive', 'Receive ID'),
    'orderId' => Yii::t('receive', 'Order ID'),
    'userId' => Yii::t('receive', 'User ID'),
    'pickingId' => Yii::t('receive', 'Picking ID'),
    'password' => Yii::t('receive', 'Password'),
    'otp' => Yii::t('receive', 'Otp'),
    'refNo' => Yii::t('receive', 'Ref No'),
    'isUse' => Yii::t('receive', 'Is Use'),
    'status' => Yii::t('receive', 'Status'),
    'createDateTime' => Yii::t('receive', 'Create Date Time'),
    'updateDateTime' => Yii::t('receive', 'Update Date Time'),
];
}
}
