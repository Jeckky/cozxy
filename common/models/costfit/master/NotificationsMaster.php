<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "notifications".
*
    * @property string $notiId
    * @property string $id
    * @property string $title
    * @property string $type
    * @property integer $status
    * @property string $parentId
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
            [['notiId', 'id', 'createDateTime'], 'required'],
            [['notiId', 'id', 'status', 'parentId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'type'], 'string', 'max' => 45],
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
    'title' => Yii::t('notifications', 'Title'),
    'type' => Yii::t('notifications', 'Type'),
    'status' => Yii::t('notifications', 'Status'),
    'parentId' => Yii::t('notifications', 'Parent ID'),
    'createDateTime' => Yii::t('notifications', 'Create Date Time'),
    'updateDateTime' => Yii::t('notifications', 'Update Date Time'),
];
}
}
