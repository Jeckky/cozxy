<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "states".
*
    * @property integer $stateId
    * @property string $code
    * @property string $stateName
    * @property string $localName
    * @property string $geographyId
    * @property string $countryId
    * @property double $latitude
    * @property double $longitude
*/
class StatesMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'states';
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
            [['geographyId'], 'integer'],
            [['countryId'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['code'], 'string', 'max' => 45],
            [['stateName'], 'string', 'max' => 50],
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
    'stateId' => Yii::t('states', 'State ID'),
    'code' => Yii::t('states', 'Code'),
    'stateName' => Yii::t('states', 'State Name'),
    'localName' => Yii::t('states', 'Local Name'),
    'geographyId' => Yii::t('states', 'Geography ID'),
    'countryId' => Yii::t('states', 'Country ID'),
    'latitude' => Yii::t('states', 'Latitude'),
    'longitude' => Yii::t('states', 'Longitude'),
];
}
}
