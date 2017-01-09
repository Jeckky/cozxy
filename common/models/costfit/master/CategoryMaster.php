<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "category".
*
    * @property string $categoryId
    * @property string $supplierId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $isRoot
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
            [['supplierId', 'title', 'createDateTime'], 'required'],
            [['supplierId', 'sortOrder', 'isRoot', 'status'], 'integer'],
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
    'categoryId' => Yii::t('category', 'Category ID'),
    'supplierId' => Yii::t('category', 'Supplier ID'),
    'title' => Yii::t('category', 'Title'),
    'description' => Yii::t('category', 'Description'),
    'image' => Yii::t('category', 'Image'),
    'sortOrder' => Yii::t('category', 'Sort Order'),
    'isRoot' => Yii::t('category', 'Is Root'),
    'status' => Yii::t('category', 'Status'),
    'createDateTime' => Yii::t('category', 'Create Date Time'),
    'updateDateTime' => Yii::t('category', 'Update Date Time'),
];
}
}
