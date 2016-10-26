<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "content_group".
*
    * @property string $contentGroupId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ContentGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'content_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
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
    'contentGroupId' => Yii::t('content_group', 'Content Group ID'),
    'title' => Yii::t('content_group', 'Title'),
    'description' => Yii::t('content_group', 'Description'),
    'image' => Yii::t('content_group', 'Image'),
    'status' => Yii::t('content_group', 'Status'),
    'createDateTime' => Yii::t('content_group', 'Create Date Time'),
    'updateDateTime' => Yii::t('content_group', 'Update Date Time'),
];
}
}
