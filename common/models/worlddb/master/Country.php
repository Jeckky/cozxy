<?php

namespace common\models\worlddb\master;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $countryId
 * @property int $status
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
class Country extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbWorlddb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alpha2Code', 'alpha3Code', 'nativeName', 'flag'], 'required'],
            [['status'], 'string', 'max' => 3],
            [['name', 'nativeName', 'flag'], 'string', 'max' => 255],
            [['alpha2Code', 'alpha3Code', 'cioc'], 'string', 'max' => 10],
            [['demonym'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'countryId' => 'Country ID',
            'status' => 'Status',
            'name' => 'Name',
            'alpha2Code' => 'Alpha2 Code',
            'alpha3Code' => 'Alpha3 Code',
            'demonym' => 'Demonym',
            'nativeName' => 'Native Name',
            'flag' => 'Flag',
            'cioc' => 'Cioc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['countryId' => 'countryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryTranslations()
    {
        return $this->hasMany(CountryTranslation::className(), ['countryId' => 'countryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencies()
    {
        return $this->hasMany(Currency::className(), ['countryId' => 'countryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['countryId' => 'countryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Language::className(), ['countryId' => 'countryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(State::className(), ['countryId' => 'countryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimezones()
    {
        return $this->hasMany(Timezone::className(), ['countryId' => 'countryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZipcodes()
    {
        return $this->hasMany(Zipcode::className(), ['countryId' => 'countryId']);
    }
}
