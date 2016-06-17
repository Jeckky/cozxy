<?php

namespace common\models\dbworld\master;

use Yii;

/**
* This is the model class for table "cities".
*
    * @property integer $cityId
    * @property string $cityName
    * @property string $localName
    * @property integer $stateId
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
            [['stateId'], 'integer'],
            [['latitude', 'longitude'], 'number'],
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
    'cityName' => Yii::t('cities', 'City Name'),
    'localName' => Yii::t('cities', 'Local Name'),
    'stateId' => Yii::t('cities', 'State ID'),
    'countryId' => Yii::t('cities', 'Country ID'),
    'latitude' => Yii::t('cities', 'Latitude'),
    'longitude' => Yii::t('cities', 'Longitude'),
];
}
}
