<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\State as StateModel;
use \common\models\worlddb\query\StateQuery;
/**
* This is the model class for table "state".
*
* @property integer $stateId
* @property integer $countryId
* @property string $name
* @property string $nativeName
*
* @property City[] $cities
* @property District[] $districts
* @property Country $country
* @property Zipcode[] $zipcodes
*/

class State extends StateModel
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
    * @return \common\models\worlddb\query\StateQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new StateQuery(get_called_class());
    }
}
