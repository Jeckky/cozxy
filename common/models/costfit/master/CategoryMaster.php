<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "category".
*
    * @property string $categoryId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $parentId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CategoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'category';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['parentId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'categoryId' => Yii::t('category', 'Category ID'),
    'title' => Yii::t('category', 'Title'),
    'description' => Yii::t('category', 'Description'),
    'image' => Yii::t('category', 'Image'),
    'parentId' => Yii::t('category', 'Parent ID'),
    'status' => Yii::t('category', 'Status'),
    'createDateTime' => Yii::t('category', 'Create Date Time'),
    'updateDateTime' => Yii::t('category', 'Update Date Time'),
];
}
}
