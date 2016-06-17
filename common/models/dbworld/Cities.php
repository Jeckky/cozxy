<?php

namespace common\models\dbworld;

use Yii;
use \common\models\dbworld\master\CitiesMaster;

/**
* This is the model class for table "cities".
*
    * @property integer $cityId
    * @property string $cityName
    * @property string $localName
    * @property integer $stateId
    * @property string $countryId
    * @property double $latitude
    * @property double $longitude
*/

class Cities extends \common\models\dbworld\master\CitiesMaster{
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
