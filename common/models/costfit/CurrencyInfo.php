<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CurrencyInfoMaster;

/**
* This is the model class for table "currency_info".
*
    * @property string $countryinfoId
    * @property string $ctry_name
    * @property string $ccy_name
    * @property string $ccy
    * @property string $ccy_nbr
    * @property string $ccy_mnr_unts
    * @property string $images
    * @property string $currency_code
    * @property string $currency_name
    * @property string $currrency_symbol
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class CurrencyInfo extends \common\models\costfit\master\CurrencyInfoMaster{
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
