<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "content".
*
    * @property string $contentId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $subview
    * @property string $parentId
    * @property integer $type
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ContentMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'content';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title', 'type', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['parentId', 'type', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 500],
            [['image'], 'string', 'max' => 300],
            [['subview'], 'string', 'max' => 100],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'contentId' => Yii::t('content', 'Content ID'),
    'title' => Yii::t('content', 'Title'),
    'description' => Yii::t('content', 'Description'),
    'image' => Yii::t('content', 'Image'),
    'subview' => Yii::t('content', 'Subview'),
    'parentId' => Yii::t('content', 'Parent ID'),
    'type' => Yii::t('content', 'Type'),
    'status' => Yii::t('content', 'Status'),
    'createDateTime' => Yii::t('content', 'Create Date Time'),
    'updateDateTime' => Yii::t('content', 'Update Date Time'),
];
}
}
