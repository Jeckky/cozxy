<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CurrencyMaster;

/**
* This is the model class for table "currency".
*
    * @property string $currencyId
    * @property string $title
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Currency extends \common\models\costfit\master\CurrencyMaster{
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
