<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "promotion".
*
    * @property integer $promotionId
    * @property string $title
    * @property string $description
    * @property string $promotionCode
    * @property integer $discount
    * @property integer $discountType
    * @property integer $maximumDiscount
    * @property integer $maximum
    * @property string $startDate
    * @property string $endDate
    * @property integer $perUser
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PromotionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'promotion';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['description'], 'string'],
            [['promotionCode', 'discount', 'discountType'], 'required'],
            [['discount', 'discountType', 'maximumDiscount', 'maximum', 'perUser', 'status'], 'integer'],
            [['startDate', 'endDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'promotionCode'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'promotionId' => Yii::t('promotion', 'Promotion ID'),
    'title' => Yii::t('promotion', 'Title'),
    'description' => Yii::t('promotion', 'Description'),
    'promotionCode' => Yii::t('promotion', 'Promotion Code'),
    'discount' => Yii::t('promotion', 'Discount'),
    'discountType' => Yii::t('promotion', 'Discount Type'),
    'maximumDiscount' => Yii::t('promotion', 'Maximum Discount'),
    'maximum' => Yii::t('promotion', 'Maximum'),
    'startDate' => Yii::t('promotion', 'Start Date'),
    'endDate' => Yii::t('promotion', 'End Date'),
    'perUser' => Yii::t('promotion', 'Per User'),
    'status' => Yii::t('promotion', 'Status'),
    'createDateTime' => Yii::t('promotion', 'Create Date Time'),
    'updateDateTime' => Yii::t('promotion', 'Update Date Time'),
];
}
}
