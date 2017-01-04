<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "category_to_sub".
*
    * @property string $id
    * @property string $brandModelId
    * @property string $categoryId
    * @property string $subCategoryId
    * @property integer $isTheme
    * @property integer $isSet
    * @property integer $isType
    * @property integer $sortOrder
    * @property string $description
    * @property string $payCondition
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CategoryToSubMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'category_to_sub';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['brandModelId', 'categoryId', 'subCategoryId', 'isTheme', 'isSet', 'isType', 'sortOrder', 'status'], 'integer'],
            [['categoryId', 'subCategoryId', 'createDateTime'], 'required'],
            [['description', 'payCondition'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('category_to_sub', 'ID'),
    'brandModelId' => Yii::t('category_to_sub', 'Brand Model ID'),
    'categoryId' => Yii::t('category_to_sub', 'Category ID'),
    'subCategoryId' => Yii::t('category_to_sub', 'Sub Category ID'),
    'isTheme' => Yii::t('category_to_sub', 'Is Theme'),
    'isSet' => Yii::t('category_to_sub', 'Is Set'),
    'isType' => Yii::t('category_to_sub', 'Is Type'),
    'sortOrder' => Yii::t('category_to_sub', 'Sort Order'),
    'description' => Yii::t('category_to_sub', 'Description'),
    'payCondition' => Yii::t('category_to_sub', 'Pay Condition'),
    'status' => Yii::t('category_to_sub', 'Status'),
    'createDateTime' => Yii::t('category_to_sub', 'Create Date Time'),
    'updateDateTime' => Yii::t('category_to_sub', 'Update Date Time'),
];
}
}
