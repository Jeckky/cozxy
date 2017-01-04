<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_spec_group".
*
    * @property string $productSpecGroupId
    * @property string $productId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $parentId
    * @property integer $type
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductSpecGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_spec_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productId', 'title', 'type', 'createDateTime'], 'required'],
            [['productId', 'parentId', 'type', 'sortOrder', 'status'], 'integer'],
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
    'productSpecGroupId' => Yii::t('product_spec_group', 'Product Spec Group ID'),
    'productId' => Yii::t('product_spec_group', 'Product ID'),
    'title' => Yii::t('product_spec_group', 'Title'),
    'description' => Yii::t('product_spec_group', 'Description'),
    'image' => Yii::t('product_spec_group', 'Image'),
    'parentId' => Yii::t('product_spec_group', 'Parent ID'),
    'type' => Yii::t('product_spec_group', 'Type'),
    'sortOrder' => Yii::t('product_spec_group', 'Sort Order'),
    'status' => Yii::t('product_spec_group', 'Status'),
    'createDateTime' => Yii::t('product_spec_group', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_spec_group', 'Update Date Time'),
];
}
}
