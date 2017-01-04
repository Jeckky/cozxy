<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PartnerPromotionMaster;

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

class PartnerPromotion extends \common\models\costfit\master\PartnerPromotionMaster{
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
