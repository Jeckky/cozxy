<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CountryinfoxMaster;

/**
* This is the model class for table "countryinfox".
*
    * @property string $currency_code
    * @property string $currency_name
    * @property string $currrency_symbol
*/

class Countryinfox extends \common\models\costfit\master\CountryinfoxMaster{
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
