<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CitiesMaster;

/**
* This is the model class for table "cities".
*
    * @property string $cityId
    * @property string $code
    * @property string $cityName
    * @property string $localName
    * @property string $geographyId
    * @property string $stateId
    * @property string $countryId
    * @property double $latitude
    * @property double $longitude
*/

class Cities extends \common\models\costfit\master\CitiesMaster{
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
