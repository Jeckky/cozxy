<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "cities".
*
    * @property string $cityId
    * @property string $code
    * @property string $cityName
    * @property string $localName
    * @property string $geographyId
    * @property string $stateId
    * @property string $countryId
    * @property double $latitude
    * @property double $longitude
*/
class CitiesMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'cities';
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
            [['geographyId', 'stateId'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['code'], 'string', 'max' => 45],
            [['cityName'], 'string', 'max' => 50],
            [['localName'], 'string', 'max' => 100],
            [['countryId'], 'string', 'max' => 3],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'cityId' => Yii::t('cities', 'City ID'),
    'code' => Yii::t('cities', 'Code'),
    'cityName' => Yii::t('cities', 'City Name'),
    'localName' => Yii::t('cities', 'Local Name'),
    'geographyId' => Yii::t('cities', 'Geography ID'),
    'stateId' => Yii::t('cities', 'State ID'),
    'countryId' => Yii::t('cities', 'Country ID'),
    'latitude' => Yii::t('cities', 'Latitude'),
    'longitude' => Yii::t('cities', 'Longitude'),
];
}
}
