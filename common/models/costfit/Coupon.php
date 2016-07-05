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

}
