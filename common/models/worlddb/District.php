<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\District as DistrictModel;
use \common\models\worlddb\query\DistrictQuery;
/**
* This is the model class for table "district".
*
* @property integer $districtId
* @property integer $cityId
* @property integer $stateId
* @property integer $countryId
* @property string $name
* @property string $nativeName
*
* @property City $city
* @property Country $country
* @property State $state
* @property Zipcode[] $zipcodes
*/

class District extends DistrictModel
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
    * @return \common\models\worlddb\query\DistrictQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new DistrictQuery(get_called_class());
    }
}
