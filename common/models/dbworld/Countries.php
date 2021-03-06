<?php

namespace common\models\dbworld;

use Yii;
use \common\models\dbworld\master\CountriesMaster;

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
class Countries extends \common\models\dbworld\master\CountriesMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
            [['countryId', 'countryName', 'localName', 'webCode', 'region', 'continent', 'latitude', 'longitude', 'surfaceArea', 'population'], 'required', 'on' => 'countries_rules'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public static function CountryName($countryId) {
        $text = '';
        $country = Countries::find()->where("countryId='" . $countryId["countryId"] . "'")->one();
        if (isset($country)) {
            $text = $country->localName . " / " . $country->countryName;
        }
        return $text;
    }

}
