<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "countries".
*
    * @property string $countryId
    * @property string $countryName
    * @property string $localName
    * @property string $webCode
    * @property string $region
    * @property string $continent
    * @property double $latitude
    * @property double $longitude
    * @property double $surfaceArea
    * @property integer $population
*/
class CountriesMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'countries';
}

    /**
    * @return \yii\db\Connection the database connection used by this AR class.
    */
    public static function getDb()
    {
    return Yii::$app->get('dbWorld');
    }

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['countryId', 'localName', 'webCode', 'region', 'continent'], 'required'],
            [['continent'], 'string'],
            [['latitude', 'longitude', 'surfaceArea'], 'number'],
            [['population'], 'integer'],
            [['countryId'], 'string', 'max' => 3],
            [['countryName'], 'string', 'max' => 52],
            [['localName'], 'string', 'max' => 45],
            [['webCode'], 'string', 'max' => 2],
            [['region'], 'string', 'max' => 26],
            [['webCode'], 'unique'],
            [['countryName'], 'unique'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'countryId' => Yii::t('countries', 'Country ID'),
    'countryName' => Yii::t('countries', 'Country Name'),
    'localName' => Yii::t('countries', 'Local Name'),
    'webCode' => Yii::t('countries', 'Web Code'),
    'region' => Yii::t('countries', 'Region'),
    'continent' => Yii::t('countries', 'Continent'),
    'latitude' => Yii::t('countries', 'Latitude'),
    'longitude' => Yii::t('countries', 'Longitude'),
    'surfaceArea' => Yii::t('countries', 'Surface Area'),
    'population' => Yii::t('countries', 'Population'),
];
}
}
