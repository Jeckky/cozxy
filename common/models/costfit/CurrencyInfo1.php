<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CurrencyInfo1Master;

/**
* This is the model class for table "currency_info1".
*
    * @property string $title
    * @property string $title1
    * @property string $title2
*/

class CurrencyInfo1 extends \common\models\costfit\master\CurrencyInfo1Master{
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
