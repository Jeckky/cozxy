<?php

namespace common\models\dbworld\master;

use Yii;

/**
* This is the model class for table "district".
*
    * @property integer $districtId
    * @property string $districtName
    * @property string $localName
    * @property integer $cityId
    * @property integer $stateId
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
            [['districtId', 'cityId', 'stateId'], 'integer'],
            [['cityId'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['districtName'], 'string', 'max' => 50],
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
    'districtId' => Yii::t('district', 'District ID'),
    'districtName' => Yii::t('district', 'District Name'),
    'localName' => Yii::t('district', 'Local Name'),
    'cityId' => Yii::t('district', 'City ID'),
    'stateId' => Yii::t('district', 'State ID'),
    'countryId' => Yii::t('district', 'Country ID'),
    'latitude' => Yii::t('district', 'Latitude'),
    'longitude' => Yii::t('district', 'Longitude'),
];
}
}
