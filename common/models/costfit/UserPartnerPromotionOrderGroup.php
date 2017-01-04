<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserPartnerPromotionOrderGroupMaster;

/**
* This is the model class for table "user_partner_promotion_order_group".
*
    * @property string $userPartnerPromotionId
    * @property string $orderGroupId
*/

class UserPartnerPromotionOrderGroup extends \common\models\costfit\master\UserPartnerPromotionOrderGroupMaster{
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
