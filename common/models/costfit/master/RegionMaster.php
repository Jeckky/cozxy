<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "region".
*
    * @property string $regionId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class RegionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'region';
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
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'regionId' => Yii::t('region', 'Region ID'),
    'title' => Yii::t('region', 'Title'),
    'description' => Yii::t('region', 'Description'),
    'status' => Yii::t('region', 'Status'),
    'createDateTime' => Yii::t('region', 'Create Date Time'),
    'updateDateTime' => Yii::t('region', 'Update Date Time'),
];
}
}
