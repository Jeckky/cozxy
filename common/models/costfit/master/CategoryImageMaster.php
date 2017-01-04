<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "category_image".
*
    * @property string $categoryImageId
    * @property string $categoryId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CategoryImageMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'category_image';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['categoryId', 'image', 'createDateTime'], 'required'],
            [['categoryId', 'sortOrder', 'status'], 'integer'],
            [['description'], 'string'],
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
    'categoryImageId' => Yii::t('category_image', 'Category Image ID'),
    'categoryId' => Yii::t('category_image', 'Category ID'),
    'title' => Yii::t('category_image', 'Title'),
    'description' => Yii::t('category_image', 'Description'),
    'image' => Yii::t('category_image', 'Image'),
    'sortOrder' => Yii::t('category_image', 'Sort Order'),
    'status' => Yii::t('category_image', 'Status'),
    'createDateTime' => Yii::t('category_image', 'Create Date Time'),
    'updateDateTime' => Yii::t('category_image', 'Update Date Time'),
];
}
}
