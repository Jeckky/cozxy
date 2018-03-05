<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\Country as CountryModel;
use \common\models\worlddb\query\CountryQuery;
use yii\helpers\ArrayHelper;

/**
* This is the model class for table "country".
*
* @property integer $countryId
* @property integer $status
* @property string $name
* @property string $alpha2Code
* @property string $alpha3Code
* @property string $demonym
* @property string $nativeName
* @property string $flag
* @property string $cioc
*
* @property City[] $cities
* @property CountryTranslation[] $countryTranslations
* @property Currency[] $currencies
* @property District[] $districts
* @property Language[] $languages
* @property State[] $states
* @property Timezone[] $timezones
* @property Zipcode[] $zipcodes
*/

class Country extends CountryModel
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
    * @return \common\models\worlddb\query\CountryQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new CountryQuery(get_called_class());
    }

    public static function countryFilter()
    {
        $countries = Country::find()->orderBy(['name'=>SORT_ASC])->all();
        return ArrayHelper::map($countries, 'countryId', 'name');
    }
}
