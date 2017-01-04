<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_group_file".
*
    * @property string $orderGroupFileId
    * @property string $orderGroupId
    * @property string $fileName
    * @property string $filePath
    * @property string $senderId
    * @property string $receiverId
    * @property integer $userType
    * @property integer $status
    * @property string $createDateTime
*/
class OrderGroupFileMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_group_file';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderGroupId', 'fileName', 'filePath', 'senderId', 'receiverId', 'userType', 'createDateTime'], 'required'],
            [['orderGroupId', 'senderId', 'receiverId', 'userType', 'status'], 'integer'],
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
    'orderGroupFileId' => Yii::t('order_group_file', 'Order Group File ID'),
    'orderGroupId' => Yii::t('order_group_file', 'Order Group ID'),
    'fileName' => Yii::t('order_group_file', 'File Name'),
    'filePath' => Yii::t('order_group_file', 'File Path'),
    'senderId' => Yii::t('order_group_file', 'Sender ID'),
    'receiverId' => Yii::t('order_group_file', 'Receiver ID'),
    'userType' => Yii::t('order_group_file', 'User Type'),
    'status' => Yii::t('order_group_file', 'Status'),
    'createDateTime' => Yii::t('order_group_file', 'Create Date Time'),
];
}
}
