<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CouponMaster;

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
class Coupon extends \common\models\costfit\master\CouponMaster
{

    public $isExpired;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    public static function generateCouponCode($prefix = "")
    {
        $isDupplicate = TRUE;
        $code = \Yii::$app->security->generateRandomString(5);
        while ($isDupplicate) {
            $model = Coupon::find()->where("code='" . $code . "'")->one();
            if (isset($model)) {
                $code = \Yii::$app->security->generateRandomString(5);
            } else {
                $isDupplicate = FALSE;
            }
        }

        return $prefix . $code;
    }

    public static function getCouponAvailable($code)
    {
        $coupon = \common\models\costfit\Coupon::find()->where("code ='" . $code . "'")->one();
        if (isset($coupon)) {
            $couponNoExpired = \common\models\costfit\Coupon::find()->where("code ='" . $code . "' AND startDate <= CURDATE() AND endDate >= CURDATE()")->one();
            if (!isset($couponNoExpired)) {
                $coupon->isExpired = TRUE;
            }
            return $coupon;
        } else {
            return NULL;
        }
    }

    public static function findAvailableCouponArray()
    {
        return \common\models\costfit\Coupon::find()->where("startDate <= CURDATE() AND endDate >= CURDATE()")->all();
    }

    public static function getCouponIsExpired($couponId)
    {
        $coupon = \common\models\costfit\Coupon::find()->where("startDate <= CURDATE() AND endDate >= CURDATE() AND couponId = " . $couponId)->one();
        if (isset($coupon)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getCouponOwner()
    {
        return $this->hasOne(CouponOwner::className(), ['couponOwnerId' => 'couponOwnerId']);
    }

}
