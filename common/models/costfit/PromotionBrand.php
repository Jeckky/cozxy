<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PromotionBrandMaster;

/**
* This is the model class for table "promotion_brand".
*
    * @property string $promotionBrandId
    * @property integer $promotionId
    * @property integer $brandId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class PromotionBrand extends \common\models\costfit\master\PromotionBrandMaster{
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
