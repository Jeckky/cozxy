<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\CountryTranslation as CountryTranslationModel;
use \common\models\worlddb\query\CountryTranslationQuery;
/**
* This is the model class for table "country_translation".
*
* @property string $countryTranslationId
* @property integer $status
* @property string $code
* @property string $name
* @property integer $countryId
*
* @property Country $country
*/

class CountryTranslation extends CountryTranslationModel
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
    * @return \common\models\worlddb\query\CountryTranslationQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new CountryTranslationQuery(get_called_class());
    }
}
