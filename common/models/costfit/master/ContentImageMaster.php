<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "content_image".
*
    * @property string $contentImageId
    * @property string $contentId
    * @property string $name
    * @property string $image
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ContentImageMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'content_image';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['contentId', 'image', 'createDateTime'], 'required'],
            [['contentId', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name'], 'string', 'max' => 300],
            [['image'], 'string', 'max' => 500],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'contentImageId' => Yii::t('content_image', 'Content Image ID'),
    'contentId' => Yii::t('content_image', 'Content ID'),
    'name' => Yii::t('content_image', 'Name'),
    'image' => Yii::t('content_image', 'Image'),
    'description' => Yii::t('content_image', 'Description'),
    'status' => Yii::t('content_image', 'Status'),
    'createDateTime' => Yii::t('content_image', 'Create Date Time'),
    'updateDateTime' => Yii::t('content_image', 'Update Date Time'),
];
}
}
