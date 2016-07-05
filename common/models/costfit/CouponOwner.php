<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CouponOwnerMaster;

/**
* This is the model class for table "coupon_owner".
*
    * @property string $couponOwnerId
    * @property string $name
    * @property string $description
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Coupon[] $coupons
    */

class CouponOwner extends \common\models\costfit\master\CouponOwnerMaster{
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
}
