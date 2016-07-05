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
    * @property string $orderSummaryToDiscount
    * @property string $discountValue
    * @property string $discountPercent
    * @property string $endDate
    * @property string $startDate
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property CouponOwner $couponOwner
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
            [['code', 'noCoupon', 'endDate', 'startDate', 'image', 'createDateTime'], 'required'],
            [['couponOwnerId', 'noCoupon', 'status'], 'integer'],
            [['orderSummaryToDiscount', 'discountValue', 'discountPercent'], 'number'],
            [['endDate', 'startDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 255],
            [['couponOwnerId'], 'exist', 'skipOnError' => true, 'targetClass' => CouponOwnerMaster::className(), 'targetAttribute' => ['couponOwnerId' => 'couponOwnerId']],
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
    'orderSummaryToDiscount' => Yii::t('coupon', 'Order Summary To Discount'),
    'discountValue' => Yii::t('coupon', 'Discount Value'),
    'discountPercent' => Yii::t('coupon', 'Discount Percent'),
    'endDate' => Yii::t('coupon', 'End Date'),
    'startDate' => Yii::t('coupon', 'Start Date'),
    'image' => Yii::t('coupon', 'Image'),
    'status' => Yii::t('coupon', 'Status'),
    'createDateTime' => Yii::t('coupon', 'Create Date Time'),
    'updateDateTime' => Yii::t('coupon', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCouponOwner()
    {
    return $this->hasOne(CouponOwnerMaster::className(), ['couponOwnerId' => 'couponOwnerId']);
    }
}
