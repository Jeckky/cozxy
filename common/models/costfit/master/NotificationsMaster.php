<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "notifications".
*
    * @property integer $notiId
    * @property integer $id
    * @property string $userId
    * @property string $title
    * @property string $type
    * @property integer $status
    * @property string $createBy
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class NotificationsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'notifications';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['id', 'createDateTime'], 'required'],
            [['id', 'userId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'type', 'createBy'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'notiId' => Yii::t('notifications', 'Noti ID'),
    'id' => Yii::t('notifications', 'ID'),
    'userId' => Yii::t('notifications', 'User ID'),
    'title' => Yii::t('notifications', 'Title'),
    'type' => Yii::t('notifications', 'Type'),
    'status' => Yii::t('notifications', 'Status'),
    'createBy' => Yii::t('notifications', 'Create By'),
    'createDateTime' => Yii::t('notifications', 'Create Date Time'),
    'updateDateTime' => Yii::t('notifications', 'Update Date Time'),
];
}
}
