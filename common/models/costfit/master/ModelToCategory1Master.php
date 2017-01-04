<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "model_to_category1".
*
    * @property string $id
    * @property string $brandModelId
    * @property string $categoryId
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ModelToCategory1Master extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'model_to_category1';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['brandModelId', 'categoryId', 'createDateTime'], 'required'],
            [['brandModelId', 'categoryId', 'sortOrder', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('model_to_category1', 'ID'),
    'brandModelId' => Yii::t('model_to_category1', 'Brand Model ID'),
    'categoryId' => Yii::t('model_to_category1', 'Category ID'),
    'sortOrder' => Yii::t('model_to_category1', 'Sort Order'),
    'status' => Yii::t('model_to_category1', 'Status'),
    'createDateTime' => Yii::t('model_to_category1', 'Create Date Time'),
    'updateDateTime' => Yii::t('model_to_category1', 'Update Date Time'),
];
}
}
