<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_group_send_work".
*
    * @property string $orderGroupSendWorkId
    * @property string $orderGroupId
    * @property integer $seq
    * @property string $title
    * @property string $image
    * @property string $remark
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class OrderGroupSendWorkMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_group_send_work';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderGroupId', 'seq', 'title', 'image', 'createDateTime'], 'required'],
            [['orderGroupId', 'seq', 'status'], 'integer'],
            [['remark'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderGroupSendWorkId' => Yii::t('order_group_send_work', 'Order Group Send Work ID'),
    'orderGroupId' => Yii::t('order_group_send_work', 'Order Group ID'),
    'seq' => Yii::t('order_group_send_work', 'Seq'),
    'title' => Yii::t('order_group_send_work', 'Title'),
    'image' => Yii::t('order_group_send_work', 'Image'),
    'remark' => Yii::t('order_group_send_work', 'Remark'),
    'status' => Yii::t('order_group_send_work', 'Status'),
    'createDateTime' => Yii::t('order_group_send_work', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_group_send_work', 'Update Date Time'),
];
}
}
