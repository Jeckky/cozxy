<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "category_brand_promotion".
*
    * @property string $categoryBrandId
    * @property integer $categoryId
    * @property integer $brandId
    * @property integer $promotionId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CategoryBrandPromotionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'category_brand_promotion';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['categoryId', 'brandId', 'promotionId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'categoryBrandId' => Yii::t('category_brand_promotion', 'Category Brand ID'),
    'categoryId' => Yii::t('category_brand_promotion', 'Category ID'),
    'brandId' => Yii::t('category_brand_promotion', 'Brand ID'),
    'promotionId' => Yii::t('category_brand_promotion', 'Promotion ID'),
    'status' => Yii::t('category_brand_promotion', 'Status'),
    'createDateTime' => Yii::t('category_brand_promotion', 'Create Date Time'),
    'updateDateTime' => Yii::t('category_brand_promotion', 'Update Date Time'),
];
}
}
