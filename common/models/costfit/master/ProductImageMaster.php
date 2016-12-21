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
    * @property string $imageThumbnail1
    * @property string $imageThumbnail2
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
            [['productId', 'title', 'createDateTime'], 'required'],
            [['productId', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image', 'imageThumbnail1', 'imageThumbnail2'], 'string', 'max' => 255],
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
    'imageThumbnail1' => Yii::t('product_image', 'Image Thumbnail1'),
    'imageThumbnail2' => Yii::t('product_image', 'Image Thumbnail2'),
    'status' => Yii::t('product_image', 'Status'),
    'createDateTime' => Yii::t('product_image', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_image', 'Update Date Time'),
];
}
}
