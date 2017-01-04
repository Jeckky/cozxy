<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserPartnerPromotionMaster;

/**
* This is the model class for table "user_partner_promotion".
*
    * @property string $id
    * @property string $userId
    * @property string $partnerPromotionId
    * @property integer $status
*/

class UserPartnerPromotion extends \common\models\costfit\master\UserPartnerPromotionMaster{
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
