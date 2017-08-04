<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "currency_info".
*
    * @property string $currencyId
    * @property string $ctry_name
    * @property string $ccy_name
    * @property string $ccy_name_th
    * @property string $ccy
    * @property string $ccy_nbr
    * @property string $ccy_mnr_unts
    * @property string $images
    * @property string $currency_code
    * @property string $currency_name
    * @property string $currrency_symbol
    * @property string $toThb
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CurrencyInfoMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'currency_info';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['toThb'], 'number'],
            [['status'], 'integer'],
            [['createDateTime'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['ctry_name', 'ccy_name', 'ccy_name_th', 'ccy', 'ccy_nbr', 'ccy_mnr_unts', 'images'], 'string', 'max' => 45],
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
    'currencyId' => Yii::t('currency_info', 'Currency ID'),
    'ctry_name' => Yii::t('currency_info', 'Ctry Name'),
    'ccy_name' => Yii::t('currency_info', 'Ccy Name'),
    'ccy_name_th' => Yii::t('currency_info', 'Ccy Name Th'),
    'ccy' => Yii::t('currency_info', 'Ccy'),
    'ccy_nbr' => Yii::t('currency_info', 'Ccy Nbr'),
    'ccy_mnr_unts' => Yii::t('currency_info', 'Ccy Mnr Unts'),
    'images' => Yii::t('currency_info', 'Images'),
    'currency_code' => Yii::t('currency_info', 'Currency Code'),
    'currency_name' => Yii::t('currency_info', 'Currency Name'),
    'currrency_symbol' => Yii::t('currency_info', 'Currrency Symbol'),
    'toThb' => Yii::t('currency_info', 'To Thb'),
    'status' => Yii::t('currency_info', 'Status'),
    'createDateTime' => Yii::t('currency_info', 'Create Date Time'),
    'updateDateTime' => Yii::t('currency_info', 'Update Date Time'),
];
}
}
