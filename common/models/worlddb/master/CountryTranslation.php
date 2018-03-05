<?php

namespace common\models\worlddb\master;

use Yii;

/**
 * This is the model class for table "country_translation".
 *
 * @property string $countryTranslationId
 * @property int $status
 * @property string $code
 * @property string $name
 * @property int $countryId
 *
 * @property Country $country
 */
class CountryTranslation extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country_translation';
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
            [['code', 'name', 'countryId'], 'required'],
            [['countryId'], 'integer'],
            [['status'], 'string', 'max' => 3],
            [['code'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 255],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countryId' => 'countryId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'countryTranslationId' => 'Country Translation ID',
            'status' => 'Status',
            'code' => 'Code',
            'name' => 'Name',
            'countryId' => 'Country ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['countryId' => 'countryId']);
    }
}
