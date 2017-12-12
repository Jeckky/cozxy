<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "promotion_category".
*
    * @property string $promotionCategoryId
    * @property integer $promotionId
    * @property integer $categoryId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PromotionCategoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'promotion_category';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['promotionId', 'categoryId'], 'required'],
            [['promotionId', 'categoryId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'promotionCategoryId' => Yii::t('promotion_category', 'Promotion Category ID'),
    'promotionId' => Yii::t('promotion_category', 'Promotion ID'),
    'categoryId' => Yii::t('promotion_category', 'Category ID'),
    'status' => Yii::t('promotion_category', 'Status'),
    'createDateTime' => Yii::t('promotion_category', 'Create Date Time'),
    'updateDateTime' => Yii::t('promotion_category', 'Update Date Time'),
];
}
}
