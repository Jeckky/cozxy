<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "currency".
*
    * @property string $currencyId
    * @property string $title
    * @property string $symbol
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CurrencyMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'currency';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['symbol'], 'string', 'max' => 50],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'currencyId' => Yii::t('currency', 'Currency ID'),
    'title' => Yii::t('currency', 'Title'),
    'symbol' => Yii::t('currency', 'Symbol'),
    'status' => Yii::t('currency', 'Status'),
    'createDateTime' => Yii::t('currency', 'Create Date Time'),
    'updateDateTime' => Yii::t('currency', 'Update Date Time'),
];
}
}
