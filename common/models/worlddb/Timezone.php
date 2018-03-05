<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\Timezone as TimezoneModel;
use \common\models\worlddb\query\TimezoneQuery;
/**
* This is the model class for table "timezone".
*
* @property integer $timezoneId
* @property integer $status
* @property string $timezone
* @property integer $countryId
*
* @property Country $country
*/

class Timezone extends TimezoneModel
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
    * @return \common\models\worlddb\query\TimezoneQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new TimezoneQuery(get_called_class());
    }
}
