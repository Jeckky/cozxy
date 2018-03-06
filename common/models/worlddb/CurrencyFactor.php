<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\CurrencyFactor as CurrencyFactorModel;
use \common\models\worlddb\query\CurrencyFactorQuery;
/**
* This is the model class for table "currency_factor".
*
* @property string $currencyFactorId
* @property integer $status
* @property double $factor
* @property string $currencyConversionId
*/

class CurrencyFactor extends CurrencyFactorModel
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    /**
    * @inheritdoc
    * @return \common\models\worlddb\query\CurrencyFactorQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new CurrencyFactorQuery(get_called_class());
    }
}
