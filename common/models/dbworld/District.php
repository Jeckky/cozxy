<?php

namespace common\models\dbworld;

use Yii;
use \common\models\dbworld\master\DistrictMaster;

/**
* This is the model class for table "district".
*
    * @property integer $districtId
    * @property string $districtName
    * @property string $localName
    * @property integer $cityId
    * @property integer $stateId
    * @property string $countryId
    * @property double $latitude
    * @property double $longitude
*/

class District extends \common\models\dbworld\master\DistrictMaster{
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
