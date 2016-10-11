<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_price_match_group".
*
    * @property string $productPriceMatchGroupId
    * @property string $title
    * @property string $description
    * @property integer $discountPercent
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductPriceMatchGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_price_match_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['discountPercent', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productPriceMatchGroupId' => Yii::t('product_price_match_group', 'Product Price Match Group ID'),
    'title' => Yii::t('product_price_match_group', 'Title'),
    'description' => Yii::t('product_price_match_group', 'Description'),
    'discountPercent' => Yii::t('product_price_match_group', 'Discount Percent'),
    'status' => Yii::t('product_price_match_group', 'Status'),
    'createDateTime' => Yii::t('product_price_match_group', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_price_match_group', 'Update Date Time'),
];
}
}
