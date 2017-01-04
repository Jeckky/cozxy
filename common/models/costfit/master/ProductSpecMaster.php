<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_spec".
*
    * @property string $productSpecId
    * @property string $productSpecGroupId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $videoEmbeded
    * @property integer $sortOrder
    * @property integer $spanWidth
    * @property integer $showTitleType
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductSpecMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_spec';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productSpecGroupId', 'title', 'createDateTime'], 'required'],
            [['productSpecGroupId', 'sortOrder', 'spanWidth', 'showTitleType', 'status'], 'integer'],
            [['description', 'videoEmbeded'], 'string'],
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
    'productSpecId' => Yii::t('product_spec', 'Product Spec ID'),
    'productSpecGroupId' => Yii::t('product_spec', 'Product Spec Group ID'),
    'title' => Yii::t('product_spec', 'Title'),
    'description' => Yii::t('product_spec', 'Description'),
    'image' => Yii::t('product_spec', 'Image'),
    'videoEmbeded' => Yii::t('product_spec', 'Video Embeded'),
    'sortOrder' => Yii::t('product_spec', 'Sort Order'),
    'spanWidth' => Yii::t('product_spec', 'Span Width'),
    'showTitleType' => Yii::t('product_spec', 'Show Title Type'),
    'status' => Yii::t('product_spec', 'Status'),
    'createDateTime' => Yii::t('product_spec', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_spec', 'Update Date Time'),
];
}
}
