<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_post".
*
    * @property string $productPostId
    * @property string $productSuppId
    * @property string $productSelfId
    * @property string $brandId
    * @property string $userId
    * @property string $title
    * @property string $shortDescription
    * @property string $description
    * @property string $shopName
    * @property string $price
    * @property string $country
    * @property string $currency
    * @property string $image
    * @property integer $isPublic
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
            [['productSuppId', 'productSelfId', 'brandId', 'userId', 'price', 'isPublic', 'status'], 'integer'],
            [['productSelfId', 'userId', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 150],
            [['shortDescription', 'shopName'], 'string', 'max' => 200],
            [['country', 'currency'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 255],
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
    'productSelfId' => Yii::t('product_post', 'Product Self ID'),
    'brandId' => Yii::t('product_post', 'Brand ID'),
    'userId' => Yii::t('product_post', 'User ID'),
    'title' => Yii::t('product_post', 'Title'),
    'shortDescription' => Yii::t('product_post', 'Short Description'),
    'description' => Yii::t('product_post', 'Description'),
    'shopName' => Yii::t('product_post', 'Shop Name'),
    'price' => Yii::t('product_post', 'Price'),
    'country' => Yii::t('product_post', 'Country'),
    'currency' => Yii::t('product_post', 'Currency'),
    'image' => Yii::t('product_post', 'Image'),
    'isPublic' => Yii::t('product_post', 'Is Public'),
    'status' => Yii::t('product_post', 'Status'),
    'createDateTime' => Yii::t('product_post', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_post', 'Update Date Time'),
];
}
}
