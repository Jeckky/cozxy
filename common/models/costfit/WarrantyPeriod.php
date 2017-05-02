<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\WarrantyPeriodMaster;

/**
* This is the model class for table "warranty_period".
*
    * @property string $warrantyPeriodId
    * @property string $title
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class WarrantyPeriod extends \common\models\costfit\master\WarrantyPeriodMaster{
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
