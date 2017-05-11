<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "district".
*
    * @property string $districtId
    * @property string $code
    * @property string $districtName
    * @property string $localName
    * @property integer $cityId
    * @property string $stateId
    * @property string $geographyId
    * @property string $countryId
    * @property double $latitude
    * @property double $longitude
*/
class DistrictMaster extends \common\models\ModelMaster
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
    return Yii::$app->get('dbWorld');
    }

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['districtId', 'cityId'], 'required'],
            [['districtId', 'cityId', 'stateId', 'geographyId'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['code'], 'string', 'max' => 45],
            [['districtName'], 'string', 'max' => 50],
            [['localName'], 'string', 'max' => 100],
            [['countryId'], 'string', 'max' => 3],
            [['districtId'], 'unique'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'districtId' => Yii::t('district', 'District ID'),
    'code' => Yii::t('district', 'Code'),
    'districtName' => Yii::t('district', 'District Name'),
    'localName' => Yii::t('district', 'Local Name'),
    'cityId' => Yii::t('district', 'City ID'),
    'stateId' => Yii::t('district', 'State ID'),
    'geographyId' => Yii::t('district', 'Geography ID'),
    'countryId' => Yii::t('district', 'Country ID'),
    'latitude' => Yii::t('district', 'Latitude'),
    'longitude' => Yii::t('district', 'Longitude'),
];
}
}
