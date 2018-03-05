<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\Currency as CurrencyModel;
use \common\models\worlddb\query\CurrencyQuery;
use yii\helpers\ArrayHelper;
use yii\db\Expression;

/**
 * This is the model class for table "currency".
 *
 * @property integer $currencyId
 * @property string $code
 * @property string $name
 * @property string $symbol
 * @property string $nativeName
 * @property integer $countryId
 *
 * @property Country $country
 * @property CurrencyConversion[] $currencyConversions
 * @property CurrencyConversion[] $currencyConversions0
 */
class Currency extends CurrencyModel
{
    public $convertFrom;
    public $convertTo;

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
     * @return \common\models\worlddb\query\CurrencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CurrencyQuery(get_called_class());
    }

    public function getCurrencyCountry()
    {
        return $this->code.' ('.$this->country->name.')';
    }

    public static function getCurrencyCodeArray()
    {
        $cs = Currency::find()->where('countryId is not null')->orderBy([new Expression('FIELD (code, "USD", "THB") DESC, code')])->groupBy('code')->all();

        return  ArrayHelper::map($cs, 'currencyId', 'currencyCountry');
    }
}
