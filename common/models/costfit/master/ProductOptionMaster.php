<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_option".
*
    * @property string $productOptionId
    * @property string $productOptionGroupId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $priceValue
    * @property string $pricePercent
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductOptionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_option';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productOptionGroupId', 'title', 'createDateTime'], 'required'],
            [['productOptionGroupId', 'status'], 'integer'],
            [['description'], 'string'],
            [['priceValue', 'pricePercent'], 'number'],
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
    'productOptionId' => Yii::t('product_option', 'Product Option ID'),
    'productOptionGroupId' => Yii::t('product_option', 'Product Option Group ID'),
    'title' => Yii::t('product_option', 'Title'),
    'description' => Yii::t('product_option', 'Description'),
    'image' => Yii::t('product_option', 'Image'),
    'priceValue' => Yii::t('product_option', 'Price Value'),
    'pricePercent' => Yii::t('product_option', 'Price Percent'),
    'status' => Yii::t('product_option', 'Status'),
    'createDateTime' => Yii::t('product_option', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_option', 'Update Date Time'),
];
}
}
