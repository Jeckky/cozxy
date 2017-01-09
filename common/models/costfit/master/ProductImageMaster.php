<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_image".
*
    * @property string $productImageId
    * @property string $productId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductImageMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_image';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productId', 'image', 'createDateTime'], 'required'],
            [['productId', 'sortOrder', 'status'], 'integer'],
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
    'productImageId' => Yii::t('product_image', 'Product Image ID'),
    'productId' => Yii::t('product_image', 'Product ID'),
    'title' => Yii::t('product_image', 'Title'),
    'description' => Yii::t('product_image', 'Description'),
    'image' => Yii::t('product_image', 'Image'),
    'sortOrder' => Yii::t('product_image', 'Sort Order'),
    'status' => Yii::t('product_image', 'Status'),
    'createDateTime' => Yii::t('product_image', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_image', 'Update Date Time'),
];
}
}
