<?php

namespace common\models\worlddb\master;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $currencyId
 * @property string $code
 * @property string $name
 * @property string $symbol
 * @property string $nativeName
 * @property int $countryId
 *
 * @property Country $country
 * @property CurrencyConversion[] $currencyConversions
 * @property CurrencyConversion[] $currencyConversions0
 */
class Currency extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
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
            [['code', 'name'], 'required'],
            [['countryId'], 'integer'],
            [['code', 'symbol'], 'string', 'max' => 10],
            [['name', 'nativeName'], 'string', 'max' => 255],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countryId' => 'countryId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'currencyId' => 'Currency ID',
            'code' => 'Code',
            'name' => 'Name',
            'symbol' => 'Symbol',
            'nativeName' => 'Native Name',
            'countryId' => 'Country ID',
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
    public function getCurrencyConversions()
    {
        return $this->hasMany(CurrencyConversion::className(), ['convertFrom' => 'currencyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyConversions0()
    {
        return $this->hasMany(CurrencyConversion::className(), ['convertTo' => 'currencyId']);
    }
}
