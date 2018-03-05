<?php

namespace common\models\worlddb\master;

use Yii;

/**
 * This is the model class for table "currency_factor".
 *
 * @property string $currencyFactorId
 * @property int $status
 * @property double $factor
 * @property string $currencyConversionId
 * @property string $createDateTime
 *
 * @property CurrencyConversion $currencyConversion
 */
class CurrencyFactor extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency_factor';
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
            [['factor', 'currencyConversionId', 'createDateTime'], 'required'],
            [['factor'], 'number'],
            [['currencyConversionId'], 'integer'],
            [['createDateTime'], 'safe'],
            [['status'], 'string', 'max' => 5],
            [['currencyConversionId'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencyConversion::className(), 'targetAttribute' => ['currencyConversionId' => 'currencyConversionId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'currencyFactorId' => 'Currency Factor ID',
            'status' => 'Status',
            'factor' => 'Factor',
            'currencyConversionId' => 'Currency Conversion ID',
            'createDateTime' => 'Create Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyConversion()
    {
        return $this->hasOne(CurrencyConversion::className(), ['currencyConversionId' => 'currencyConversionId']);
    }
}
