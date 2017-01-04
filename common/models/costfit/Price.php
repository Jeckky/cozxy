<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PriceMaster;

/**
* This is the model class for table "price".
*
    * @property string $priceId
    * @property string $priceGroupId
    * @property string $provinceId
    * @property string $amphurId
    * @property string $priceRate
    * @property integer $status
*/

class Price extends \common\models\costfit\master\PriceMaster{
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
