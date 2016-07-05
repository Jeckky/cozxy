<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "coupon".
*
    * @property string $couponId
    * @property string $code
    * @property string $orderSummaryToDiscount
    * @property string $discountValue
    * @property string $discountPercent
    * @property string $endDate
    * @property string $startDate
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CouponMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'coupon';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['code', 'endDate', 'startDate', 'createDateTime'], 'required'],
            [['orderSummaryToDiscount', 'discountValue', 'discountPercent'], 'number'],
            [['endDate', 'startDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'integer'],
            [['code'], 'string', 'max' => 50],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'couponId' => Yii::t('coupon', 'Coupon ID'),
    'code' => Yii::t('coupon', 'Code'),
    'orderSummaryToDiscount' => Yii::t('coupon', 'Order Summary To Discount'),
    'discountValue' => Yii::t('coupon', 'Discount Value'),
    'discountPercent' => Yii::t('coupon', 'Discount Percent'),
    'endDate' => Yii::t('coupon', 'End Date'),
    'startDate' => Yii::t('coupon', 'Start Date'),
    'status' => Yii::t('coupon', 'Status'),
    'createDateTime' => Yii::t('coupon', 'Create Date Time'),
    'updateDateTime' => Yii::t('coupon', 'Update Date Time'),
];
}
}
