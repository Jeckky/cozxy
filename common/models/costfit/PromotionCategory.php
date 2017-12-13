<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PromotionCategoryMaster;

/**
* This is the model class for table "promotion_category".
*
    * @property string $promotionCategoryId
    * @property integer $promotionId
    * @property integer $categoryId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class PromotionCategory extends \common\models\costfit\master\PromotionCategoryMaster{
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
