<?php

namespace common\models\worlddb\master;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $cityId
 * @property int $stateId
 * @property int $countryId
 * @property string $name
 * @property string $nativeName
 * @property string $code
 *
 * @property Country $country
 * @property State $state
 * @property District[] $districts
 * @property Zipcode[] $zipcodes
 */
class City extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
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
            [['stateId', 'name'], 'required'],
            [['stateId', 'countryId'], 'integer'],
            [['name', 'nativeName'], 'string', 'max' => 45],
            [['code'], 'string', 'max' => 20],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countryId' => 'countryId']],
            [['stateId'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['stateId' => 'stateId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cityId' => 'City ID',
            'stateId' => 'State ID',
            'countryId' => 'Country ID',
            'name' => 'Name',
            'nativeName' => 'Native Name',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['countryId' => 'countryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['stateId' => 'stateId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['cityId' => 'cityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZipcodes()
    {
        return $this->hasMany(Zipcode::className(), ['cityId' => 'cityId']);
    }
}
