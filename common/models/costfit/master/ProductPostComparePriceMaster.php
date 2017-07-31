<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_post_compare_price".
*
    * @property string $comparePriceId
    * @property string $productPostId
    * @property string $productId
    * @property string $userId
    * @property string $productSelfId
    * @property string $shopName
    * @property string $price
    * @property string $country
    * @property string $currency
    * @property integer $status
    * @property string $longitude
    * @property string $latitude
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductPostComparePriceMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_post_compare_price';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productPostId', 'userId', 'createDateTime'], 'required'],
            [['productPostId', 'productId', 'userId', 'productSelfId', 'price', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['shopName'], 'string', 'max' => 200],
            [['country', 'currency'], 'string', 'max' => 100],
            [['longitude', 'latitude'], 'string', 'max' => 50],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'comparePriceId' => Yii::t('product_post_compare_price', 'Compare Price ID'),
    'productPostId' => Yii::t('product_post_compare_price', 'Product Post ID'),
    'productId' => Yii::t('product_post_compare_price', 'Product ID'),
    'userId' => Yii::t('product_post_compare_price', 'User ID'),
    'productSelfId' => Yii::t('product_post_compare_price', 'Product Self ID'),
    'shopName' => Yii::t('product_post_compare_price', 'Shop Name'),
    'price' => Yii::t('product_post_compare_price', 'Price'),
    'country' => Yii::t('product_post_compare_price', 'Country'),
    'currency' => Yii::t('product_post_compare_price', 'Currency'),
    'status' => Yii::t('product_post_compare_price', 'Status'),
    'longitude' => Yii::t('product_post_compare_price', 'Longitude'),
    'latitude' => Yii::t('product_post_compare_price', 'Latitude'),
    'createDateTime' => Yii::t('product_post_compare_price', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_post_compare_price', 'Update Date Time'),
];
}
}
