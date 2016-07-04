<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "show_category".
*
    * @property string $showCategoryId
    * @property string $categoryId
    * @property integer $type
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ShowCategoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'show_category';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['categoryId', 'type', 'createDateTime'], 'required'],
            [['categoryId', 'type', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'showCategoryId' => Yii::t('show_category', 'Show Category ID'),
    'categoryId' => Yii::t('show_category', 'Category ID'),
    'type' => Yii::t('show_category', 'Type'),
    'status' => Yii::t('show_category', 'Status'),
    'createDateTime' => Yii::t('show_category', 'Create Date Time'),
    'updateDateTime' => Yii::t('show_category', 'Update Date Time'),
];
}
}
