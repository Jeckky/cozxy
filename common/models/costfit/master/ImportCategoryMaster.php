<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "import_category".
*
    * @property integer $categoryId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $parentId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ImportCategoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'import_category';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['categoryId', 'createDateTime'], 'required'],
            [['categoryId', 'parentId', 'status'], 'integer'],
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
    'categoryId' => Yii::t('import_category', 'Category ID'),
    'title' => Yii::t('import_category', 'Title'),
    'description' => Yii::t('import_category', 'Description'),
    'image' => Yii::t('import_category', 'Image'),
    'parentId' => Yii::t('import_category', 'Parent ID'),
    'status' => Yii::t('import_category', 'Status'),
    'createDateTime' => Yii::t('import_category', 'Create Date Time'),
    'updateDateTime' => Yii::t('import_category', 'Update Date Time'),
];
}
}
