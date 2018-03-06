<?php

namespace common\models\worlddb\master;

use Yii;

/**
 * This is the model class for table "currency_conversion".
 *
 * @property string $currencyConversionId
 * @property int $status
 * @property int $convertFrom
 * @property int $convertTo
 * @property string $conversion
 * @property double $factor
 * @property int $createDateTime
 *
 * @property Currency $convertFrom0
 * @property Currency $convertTo0
 * @property CurrencyFactor[] $currencyFactors
 */
class CurrencyConversion extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency_conversion';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbWorlddb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['convertFrom', 'convertTo', 'conversion', 'factor', 'createDateTime'], 'required'],
            [['convertFrom', 'convertTo', 'createDateTime'], 'integer'],
            [['factor'], 'number'],
            [['status'], 'string', 'max' => 3],
            [['conversion'], 'string', 'max' => 20],
            [['convertFrom'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['convertFrom' => 'currencyId']],
            [['convertTo'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['convertTo' => 'currencyId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'currencyConversionId' => 'Currency Conversion ID',
            'status' => 'Status',
            'convertFrom' => 'Convert From',
            'convertTo' => 'Convert To',
            'conversion' => 'Conversion',
            'factor' => 'Factor',
            'createDateTime' => 'Create Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConvertFrom0()
    {
        return $this->hasOne(Currency::className(), ['currencyId' => 'convertFrom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConvertTo0()
    {
        return $this->hasOne(Currency::className(), ['currencyId' => 'convertTo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyFactors()
    {
        return $this->hasMany(CurrencyFactor::className(), ['currencyConversionId' => 'currencyConversionId']);
    }
}
