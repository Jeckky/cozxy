<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "view_levels".
*
    * @property integer $viewLevelsId
    * @property string $title
    * @property string $desc
    * @property integer $ordering
    * @property string $rules
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ViewLevelsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'view_levels';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['ordering', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['desc', 'rules'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'viewLevelsId' => Yii::t('view_levels', 'View Levels ID'),
    'title' => Yii::t('view_levels', 'Title'),
    'desc' => Yii::t('view_levels', 'Desc'),
    'ordering' => Yii::t('view_levels', 'Ordering'),
    'rules' => Yii::t('view_levels', 'Rules'),
    'status' => Yii::t('view_levels', 'Status'),
    'createDateTime' => Yii::t('view_levels', 'Create Date Time'),
    'updateDateTime' => Yii::t('view_levels', 'Update Date Time'),
];
}
}
