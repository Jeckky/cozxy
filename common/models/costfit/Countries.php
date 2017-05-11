<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CountriesMaster;

/**
* This is the model class for table "countries".
*
    * @property string $countryId
    * @property string $countryName
    * @property string $localName
    * @property string $webCode
    * @property string $region
    * @property string $continent
    * @property double $latitude
    * @property double $longitude
    * @property double $surfaceArea
    * @property integer $population
*/

class Countries extends \common\models\costfit\master\CountriesMaster{
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
