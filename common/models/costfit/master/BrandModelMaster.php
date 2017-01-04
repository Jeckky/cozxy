<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "brand_model".
*
    * @property string $brandModelId
    * @property string $brandId
    * @property string $supplierId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class BrandModelMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'brand_model';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['brandId', 'supplierId', 'title', 'createDateTime'], 'required'],
            [['brandId', 'supplierId', 'sortOrder', 'status'], 'integer'],
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
    'brandModelId' => Yii::t('brand_model', 'Brand Model ID'),
    'brandId' => Yii::t('brand_model', 'Brand ID'),
    'supplierId' => Yii::t('brand_model', 'Supplier ID'),
    'title' => Yii::t('brand_model', 'Title'),
    'description' => Yii::t('brand_model', 'Description'),
    'image' => Yii::t('brand_model', 'Image'),
    'sortOrder' => Yii::t('brand_model', 'Sort Order'),
    'status' => Yii::t('brand_model', 'Status'),
    'createDateTime' => Yii::t('brand_model', 'Create Date Time'),
    'updateDateTime' => Yii::t('brand_model', 'Update Date Time'),
];
}
}
