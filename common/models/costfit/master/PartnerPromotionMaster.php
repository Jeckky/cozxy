<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "partner_promotion".
*
    * @property string $id
    * @property string $title
    * @property string $supplierId
    * @property string $startDate
    * @property string $endDate
    * @property integer $partnerType
    * @property string $discountPercent
    * @property string $discountValue
    * @property integer $promotionType
    * @property string $buySummary
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PartnerPromotionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'partner_promotion';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['id', 'title', 'supplierId', 'startDate', 'endDate', 'discountPercent', 'discountValue', 'buySummary', 'createDateTime'], 'required'],
            [['id', 'supplierId', 'partnerType', 'promotionType', 'status'], 'integer'],
            [['startDate', 'endDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['discountPercent', 'discountValue', 'buySummary'], 'number'],
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
    'id' => Yii::t('partner_promotion', 'ID'),
    'title' => Yii::t('partner_promotion', 'Title'),
    'supplierId' => Yii::t('partner_promotion', 'Supplier ID'),
    'startDate' => Yii::t('partner_promotion', 'Start Date'),
    'endDate' => Yii::t('partner_promotion', 'End Date'),
    'partnerType' => Yii::t('partner_promotion', 'Partner Type'),
    'discountPercent' => Yii::t('partner_promotion', 'Discount Percent'),
    'discountValue' => Yii::t('partner_promotion', 'Discount Value'),
    'promotionType' => Yii::t('partner_promotion', 'Promotion Type'),
    'buySummary' => Yii::t('partner_promotion', 'Buy Summary'),
    'image' => Yii::t('partner_promotion', 'Image'),
    'status' => Yii::t('partner_promotion', 'Status'),
    'createDateTime' => Yii::t('partner_promotion', 'Create Date Time'),
    'updateDateTime' => Yii::t('partner_promotion', 'Update Date Time'),
];
}
}
