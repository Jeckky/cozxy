<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\City as CityModel;
use \common\models\worlddb\query\CityQuery;
/**
* This is the model class for table "city".
*
* @property integer $cityId
* @property integer $stateId
* @property integer $countryId
* @property string $name
* @property string $nativeName
*
* @property Country $country
* @property State $state
* @property District[] $districts
* @property Zipcode[] $zipcodes
*/

class City extends CityModel
{
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

    /**
    * @inheritdoc
    * @return \common\models\worlddb\query\CityQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new CityQuery(get_called_class());
    }
}
