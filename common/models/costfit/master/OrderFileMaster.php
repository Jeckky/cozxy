<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_file".
*
    * @property string $orderFileId
    * @property string $orderId
    * @property string $fileName
    * @property string $filePath
    * @property string $senderId
    * @property string $receiverId
    * @property integer $userType
    * @property integer $status
    * @property string $createDateTime
*/
class OrderFileMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_file';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderId', 'fileName', 'filePath', 'userType', 'createDateTime'], 'required'],
            [['orderId', 'senderId', 'receiverId', 'userType', 'status'], 'integer'],
            [['fileName'], 'string', 'max' => 200],
            [['filePath'], 'string', 'max' => 1000],
            [['createDateTime'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderFileId' => Yii::t('order_file', 'Order File ID'),
    'orderId' => Yii::t('order_file', 'Order ID'),
    'fileName' => Yii::t('order_file', 'File Name'),
    'filePath' => Yii::t('order_file', 'File Path'),
    'senderId' => Yii::t('order_file', 'Sender ID'),
    'receiverId' => Yii::t('order_file', 'Receiver ID'),
    'userType' => Yii::t('order_file', 'User Type'),
    'status' => Yii::t('order_file', 'Status'),
    'createDateTime' => Yii::t('order_file', 'Create Date Time'),
];
}
}
