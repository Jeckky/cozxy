<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "section".
*
    * @property string $sectionId
    * @property string $title
    * @property string $description
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
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'description'], 'string', 'max' => 255],
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
    'status' => Yii::t('section', 'Status'),
    'createDateTime' => Yii::t('section', 'Create Date Time'),
    'updateDateTime' => Yii::t('section', 'Update Date Time'),
];
}
}
