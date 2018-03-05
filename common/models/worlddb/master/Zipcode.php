<?php

namespace common\models\worlddb\master;

use Yii;

/**
 * This is the model class for table "zipcode".
 *
 * @property int $zipcodeId
 * @property string $zipcode
 * @property int $districtId
 * @property int $cityId
 * @property int $stateId
 * @property int $countryId
 *
 * @property City $city
 * @property Country $country
 * @property District $district
 * @property State $state
 */
class Zipcode extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zipcode';
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
            [['zipcodeId', 'zipcode'], 'required'],
            [['zipcodeId', 'districtId', 'cityId', 'stateId', 'countryId'], 'integer'],
            [['zipcode'], 'string', 'max' => 45],
            [['zipcodeId'], 'unique'],
            [['cityId'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['cityId' => 'cityId']],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countryId' => 'countryId']],
            [['districtId'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['districtId' => 'districtId']],
            [['stateId'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['stateId' => 'stateId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'zipcodeId' => 'Zipcode ID',
            'zipcode' => 'Zipcode',
            'districtId' => 'District ID',
            'cityId' => 'City ID',
            'stateId' => 'State ID',
            'countryId' => 'Country ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['cityId' => 'cityId']);
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
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['districtId' => 'districtId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['stateId' => 'stateId']);
    }
}
