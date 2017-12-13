<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "section".
*
    * @property string $sectionId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $type
    * @property integer $sort
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SectionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'section';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['description'], 'string'],
            [['type'], 'required'],
            [['sort', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'image'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 6],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'sectionId' => Yii::t('section', 'Section ID'),
    'title' => Yii::t('section', 'Title'),
    'description' => Yii::t('section', 'Description'),
    'image' => Yii::t('section', 'Image'),
    'type' => Yii::t('section', 'Type'),
    'sort' => Yii::t('section', 'Sort'),
    'status' => Yii::t('section', 'Status'),
    'createDateTime' => Yii::t('section', 'Create Date Time'),
    'updateDateTime' => Yii::t('section', 'Update Date Time'),
];
}
}
