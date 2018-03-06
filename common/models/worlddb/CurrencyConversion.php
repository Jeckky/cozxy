<?php

namespace common\models\worlddb;

use common\models\MasterModel;
use Yii;
use \common\models\worlddb\master\CurrencyConversion as CurrencyConversionModel;
use \common\models\worlddb\query\CurrencyConversionQuery;

/**
 * This is the model class for table "currency_conversion".
 *
 * @property string $currencyConversionId
 * @property integer $status
 * @property integer $convertFrom
 * @property integer $convertTo
 * @property string $conversion
 * @property double $factor
 * @property integer $createDateTime
 *
 * @property Currency $convertFrom0
 * @property Currency $convertTo0
 */
class CurrencyConversion extends CurrencyConversionModel
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
     * @return \common\models\worlddb\query\CurrencyConversionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CurrencyConversionQuery(get_called_class());
    }

    public static function convertBaseOnUSD($amount, $from, $to)
    {
        $convertFrom = self::find()->whereByConversion($from)->one();
        $convertTo = self::find()->whereByConversion($to)->one();

        return $convertTo->currencyFactor->factor * $amount / $convertFrom->currencyFactor->factor;
    }

    public function getCurrencyFactor()
    {
        return $this->hasOne(CurrencyFactor::className(), ['currencyConversionId' => 'currencyConversionId'])->where(['status'=>MasterModel::STATUS_ACTIVE]);
    }
}
