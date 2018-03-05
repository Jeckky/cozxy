<?php

namespace common\models\worlddb\master;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property int $districtId
 * @property int $cityId
 * @property int $stateId
 * @property int $countryId
 * @property string $name
 * @property string $nativeName
 * @property string $code
 *
 * @property City $city
 * @property Country $country
 * @property State $state
 * @property Zipcode[] $zipcodes
 */
class District extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
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
            [['cityId'], 'required'],
            [['cityId', 'stateId', 'countryId'], 'integer'],
            [['name', 'nativeName'], 'string', 'max' => 45],
            [['code'], 'string', 'max' => 20],
            [['cityId'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['cityId' => 'cityId']],
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
            'districtId' => 'District ID',
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
    public function getState()
    {
        return $this->hasOne(State::className(), ['stateId' => 'stateId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZipcodes()
    {
        return $this->hasMany(Zipcode::className(), ['districtId' => 'districtId']);
    }
}
