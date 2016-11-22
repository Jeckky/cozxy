<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_image_suppliers".
*
    * @property string $productImageId
    * @property string $productId
    * @property string $title
    * @property string $description
    * @property string $original_name
    * @property string $image
    * @property string $imageThumbnail1
    * @property string $imageThumbnail2
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductImageSuppliersMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_image_suppliers';
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
            [['original_name', 'image', 'imageThumbnail1', 'imageThumbnail2'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productImageId' => Yii::t('product_image_suppliers', 'Product Image ID'),
    'productId' => Yii::t('product_image_suppliers', 'Product ID'),
    'title' => Yii::t('product_image_suppliers', 'Title'),
    'description' => Yii::t('product_image_suppliers', 'Description'),
    'original_name' => Yii::t('product_image_suppliers', 'Original Name'),
    'image' => Yii::t('product_image_suppliers', 'Image'),
    'imageThumbnail1' => Yii::t('product_image_suppliers', 'Image Thumbnail1'),
    'imageThumbnail2' => Yii::t('product_image_suppliers', 'Image Thumbnail2'),
    'status' => Yii::t('product_image_suppliers', 'Status'),
    'createDateTime' => Yii::t('product_image_suppliers', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_image_suppliers', 'Update Date Time'),
];
}
}
