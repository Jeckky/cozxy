<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_option_group".
*
    * @property string $productOptionGroupId
    * @property string $productId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductOptionGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_option_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productId', 'title', 'createDateTime'], 'required'],
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
    'productOptionGroupId' => Yii::t('product_option_group', 'Product Option Group ID'),
    'productId' => Yii::t('product_option_group', 'Product ID'),
    'title' => Yii::t('product_option_group', 'Title'),
    'description' => Yii::t('product_option_group', 'Description'),
    'image' => Yii::t('product_option_group', 'Image'),
    'sortOrder' => Yii::t('product_option_group', 'Sort Order'),
    'status' => Yii::t('product_option_group', 'Status'),
    'createDateTime' => Yii::t('product_option_group', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_option_group', 'Update Date Time'),
];
}
}
