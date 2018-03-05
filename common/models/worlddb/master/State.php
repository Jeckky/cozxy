<?php

namespace common\models\worlddb\master;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property int $stateId
 * @property int $countryId
 * @property string $name
 * @property string $nativeName
 * @property string $code
 *
 * @property City[] $cities
 * @property District[] $districts
 * @property Country $country
 * @property Zipcode[] $zipcodes
 */
class State extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state';
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
            [['countryId'], 'required'],
            [['countryId'], 'integer'],
            [['name', 'nativeName'], 'string', 'max' => 45],
            [['code'], 'string', 'max' => 20],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countryId' => 'countryId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
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
    public function getCities()
    {
        return $this->hasMany(City::className(), ['stateId' => 'stateId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['stateId' => 'stateId']);
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
    public function getZipcodes()
    {
        return $this->hasMany(Zipcode::className(), ['stateId' => 'stateId']);
    }
}
