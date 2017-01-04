<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PriceGroupMaster;

/**
* This is the model class for table "price_group".
*
    * @property string $priceGroupId
    * @property string $priceGroupName
    * @property string $priceRate
    * @property integer $status
    * @property string $supplierId
*/

class PriceGroup extends \common\models\costfit\master\PriceGroupMaster{
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
