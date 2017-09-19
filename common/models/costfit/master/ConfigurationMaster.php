<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "configuration".
*
    * @property string $configurationId
    * @property string $title
    * @property string $description
    * @property string $value
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ConfigurationMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'configuration';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'description', 'value'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'configurationId' => Yii::t('configuration', 'Configuration ID'),
    'title' => Yii::t('configuration', 'Title'),
    'description' => Yii::t('configuration', 'Description'),
    'value' => Yii::t('configuration', 'Value'),
    'status' => Yii::t('configuration', 'Status'),
    'createDateTime' => Yii::t('configuration', 'Create Date Time'),
    'updateDateTime' => Yii::t('configuration', 'Update Date Time'),
];
}
}
