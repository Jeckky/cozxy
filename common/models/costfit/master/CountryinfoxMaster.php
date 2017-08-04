<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "countryinfox".
*
    * @property string $currency_code
    * @property string $currency_name
    * @property string $currrency_symbol
*/
class CountryinfoxMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'countryinfox';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['currency_code', 'currrency_symbol'], 'string', 'max' => 3],
            [['currency_name'], 'string', 'max' => 32],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'currency_code' => Yii::t('countryinfox', 'Currency Code'),
    'currency_name' => Yii::t('countryinfox', 'Currency Name'),
    'currrency_symbol' => Yii::t('countryinfox', 'Currrency Symbol'),
];
}
}
