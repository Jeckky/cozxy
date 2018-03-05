<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\Zipcode as ZipcodeModel;
use \common\models\worlddb\query\ZipcodeQuery;
/**
* This is the model class for table "zipcode".
*
* @property integer $zipcodeId
* @property string $zipcode
* @property integer $districtId
* @property integer $cityId
* @property integer $stateId
* @property integer $countryId
*
* @property City $city
* @property Country $country
* @property District $district
* @property State $state
*/

class Zipcode extends ZipcodeModel
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
    * @return \common\models\worlddb\query\ZipcodeQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new ZipcodeQuery(get_called_class());
    }
}
