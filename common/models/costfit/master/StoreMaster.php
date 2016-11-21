<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "store".
*
    * @property string $storeId
    * @property string $regionId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class StoreMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'store';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['regionId', 'status'], 'integer'],
            [['title', 'createDateTime'], 'required'],
            [['description'], 'string'],
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
    'storeId' => Yii::t('store', 'Store ID'),
    'regionId' => Yii::t('store', 'Region ID'),
    'title' => Yii::t('store', 'Title'),
    'description' => Yii::t('store', 'Description'),
    'status' => Yii::t('store', 'Status'),
    'createDateTime' => Yii::t('store', 'Create Date Time'),
    'updateDateTime' => Yii::t('store', 'Update Date Time'),
];
}
}
