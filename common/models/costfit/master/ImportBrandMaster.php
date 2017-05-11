<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "import_brand".
*
    * @property string $brandId
    * @property string $userId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $status
    * @property string $parentId
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ImportBrandMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'import_brand';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['brandId', 'userId', 'title', 'createDateTime'], 'required'],
            [['brandId', 'userId', 'status', 'parentId'], 'integer'],
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
    'brandId' => Yii::t('import_brand', 'Brand ID'),
    'userId' => Yii::t('import_brand', 'User ID'),
    'title' => Yii::t('import_brand', 'Title'),
    'description' => Yii::t('import_brand', 'Description'),
    'image' => Yii::t('import_brand', 'Image'),
    'status' => Yii::t('import_brand', 'Status'),
    'parentId' => Yii::t('import_brand', 'Parent ID'),
    'createDateTime' => Yii::t('import_brand', 'Create Date Time'),
    'updateDateTime' => Yii::t('import_brand', 'Update Date Time'),
];
}
}
