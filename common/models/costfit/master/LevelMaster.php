<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "level".
*
    * @property integer $levelId
    * @property string $name
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class LevelMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'level';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'levelId' => Yii::t('level', 'Level ID'),
    'name' => Yii::t('level', 'Name'),
    'status' => Yii::t('level', 'Status'),
    'createDateTime' => Yii::t('level', 'Create Date Time'),
    'updateDateTime' => Yii::t('level', 'Update Date Time'),
];
}
}
