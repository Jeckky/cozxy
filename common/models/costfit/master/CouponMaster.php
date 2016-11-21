<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "coupon".
*
    * @property string $couponId
    * @property string $code
    * @property string $couponOwnerId
    * @property integer $noCoupon
    * @property integer $oneTimeUse
    * @property string $orderSummaryToDiscount
    * @property string $discountValue
    * @property string $discountPercent
    * @property string $startDate
    * @property string $endDate
    * @property string $image
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
            [['code', 'noCoupon', 'startDate', 'endDate', 'createDateTime'], 'required'],
            [['couponOwnerId', 'noCoupon', 'oneTimeUse', 'status'], 'integer'],
            [['orderSummaryToDiscount', 'discountValue', 'discountPercent'], 'number'],
            [['startDate', 'endDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 255],
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
    'couponOwnerId' => Yii::t('coupon', 'Coupon Owner ID'),
    'noCoupon' => Yii::t('coupon', 'No Coupon'),
    'oneTimeUse' => Yii::t('coupon', 'One Time Use'),
    'orderSummaryToDiscount' => Yii::t('coupon', 'Order Summary To Discount'),
    'discountValue' => Yii::t('coupon', 'Discount Value'),
    'discountPercent' => Yii::t('coupon', 'Discount Percent'),
    'startDate' => Yii::t('coupon', 'Start Date'),
    'endDate' => Yii::t('coupon', 'End Date'),
    'image' => Yii::t('coupon', 'Image'),
    'status' => Yii::t('coupon', 'Status'),
    'createDateTime' => Yii::t('coupon', 'Create Date Time'),
    'updateDateTime' => Yii::t('coupon', 'Update Date Time'),
];
}
}
