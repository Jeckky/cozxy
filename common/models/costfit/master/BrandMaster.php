<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "brand".
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
class BrandMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'brand';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'title', 'createDateTime'], 'required'],
            [['userId', 'status', 'parentId'], 'integer'],
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
    'brandId' => Yii::t('brand', 'Brand ID'),
    'userId' => Yii::t('brand', 'User ID'),
    'title' => Yii::t('brand', 'Title'),
    'description' => Yii::t('brand', 'Description'),
    'image' => Yii::t('brand', 'Image'),
    'status' => Yii::t('brand', 'Status'),
    'parentId' => Yii::t('brand', 'Parent ID'),
    'createDateTime' => Yii::t('brand', 'Create Date Time'),
    'updateDateTime' => Yii::t('brand', 'Update Date Time'),
];
}
}
