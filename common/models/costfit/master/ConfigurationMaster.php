<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "configuration".
*
    * @property string $id
    * @property string $name
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
            [['name', 'createDateTime'], 'required'],
            [['description', 'value'], 'string'],
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('configuration', 'ID'),
    'name' => Yii::t('configuration', 'Name'),
    'description' => Yii::t('configuration', 'Description'),
    'value' => Yii::t('configuration', 'Value'),
    'status' => Yii::t('configuration', 'Status'),
    'createDateTime' => Yii::t('configuration', 'Create Date Time'),
    'updateDateTime' => Yii::t('configuration', 'Update Date Time'),
];
}
}
