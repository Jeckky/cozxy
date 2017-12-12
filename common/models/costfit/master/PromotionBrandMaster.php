<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "promotion_brand".
*
    * @property string $promotionBrandId
    * @property integer $promotionId
    * @property integer $brandId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PromotionBrandMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'promotion_brand';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['promotionId', 'brandId'], 'required'],
            [['promotionId', 'brandId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'promotionBrandId' => Yii::t('promotion_brand', 'Promotion Brand ID'),
    'promotionId' => Yii::t('promotion_brand', 'Promotion ID'),
    'brandId' => Yii::t('promotion_brand', 'Brand ID'),
    'status' => Yii::t('promotion_brand', 'Status'),
    'createDateTime' => Yii::t('promotion_brand', 'Create Date Time'),
    'updateDateTime' => Yii::t('promotion_brand', 'Update Date Time'),
];
}
}
