<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "brand_model_image".
*
    * @property string $brandModelImageId
    * @property string $brandModelId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class BrandModelImageMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'brand_model_image';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['brandModelId', 'image', 'createDateTime'], 'required'],
            [['brandModelId', 'sortOrder', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'image'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'brandModelImageId' => Yii::t('brand_model_image', 'Brand Model Image ID'),
    'brandModelId' => Yii::t('brand_model_image', 'Brand Model ID'),
    'title' => Yii::t('brand_model_image', 'Title'),
    'description' => Yii::t('brand_model_image', 'Description'),
    'image' => Yii::t('brand_model_image', 'Image'),
    'sortOrder' => Yii::t('brand_model_image', 'Sort Order'),
    'status' => Yii::t('brand_model_image', 'Status'),
    'createDateTime' => Yii::t('brand_model_image', 'Create Date Time'),
    'updateDateTime' => Yii::t('brand_model_image', 'Update Date Time'),
];
}
}
