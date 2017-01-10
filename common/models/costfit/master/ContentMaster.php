<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "content".
*
    * @property string $contentId
    * @property string $contentGroupId
    * @property string $headTitle
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $linkTitle
    * @property string $link
    * @property string $startDate
    * @property string $endDate
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
            [['contentGroupId', 'headTitle', 'createDateTime'], 'required'],
            [['contentGroupId', 'status'], 'integer'],
            [['description'], 'string'],
            [['startDate', 'endDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['headTitle', 'title', 'linkTitle', 'link'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'contentId' => Yii::t('content', 'Content ID'),
    'contentGroupId' => Yii::t('content', 'Content Group ID'),
    'headTitle' => Yii::t('content', 'Head Title'),
    'title' => Yii::t('content', 'Title'),
    'description' => Yii::t('content', 'Description'),
    'image' => Yii::t('content', 'Image'),
    'linkTitle' => Yii::t('content', 'Link Title'),
    'link' => Yii::t('content', 'Link'),
    'startDate' => Yii::t('content', 'Start Date'),
    'endDate' => Yii::t('content', 'End Date'),
    'status' => Yii::t('content', 'Status'),
    'createDateTime' => Yii::t('content', 'Create Date Time'),
    'updateDateTime' => Yii::t('content', 'Update Date Time'),
];
}
}
