<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_post".
*
    * @property string $productPostId
    * @property string $productSuppId
    * @property string $brandId
    * @property string $userId
    * @property string $title
    * @property string $shortDescription
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductPostMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_post';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productSuppId', 'brandId', 'userId', 'status'], 'integer'],
            [['userId', 'title', 'shortDescription', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['shortDescription'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productPostId' => Yii::t('product_post', 'Product Post ID'),
    'productSuppId' => Yii::t('product_post', 'Product Supp ID'),
    'brandId' => Yii::t('product_post', 'Brand ID'),
    'userId' => Yii::t('product_post', 'User ID'),
    'title' => Yii::t('product_post', 'Title'),
    'shortDescription' => Yii::t('product_post', 'Short Description'),
    'description' => Yii::t('product_post', 'Description'),
    'status' => Yii::t('product_post', 'Status'),
    'createDateTime' => Yii::t('product_post', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_post', 'Update Date Time'),
];
}
}
