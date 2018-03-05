<?php

namespace common\models\worlddb\master;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property string $languageId
 * @property string $iso639_1
 * @property string $iso639_2
 * @property string $name
 * @property string $nativeName
 * @property int $createDateTime
 * @property int $updateDateTime
 * @property int $countryId
 *
 * @property Country $country
 */
class Language extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language';
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
            [['createDateTime', 'updateDateTime', 'countryId'], 'required'],
            [['createDateTime', 'updateDateTime', 'countryId'], 'integer'],
            [['iso639_1', 'iso639_2'], 'string', 'max' => 45],
            [['name', 'nativeName'], 'string', 'max' => 255],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countryId' => 'countryId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'languageId' => 'Language ID',
            'iso639_1' => 'Iso639 1',
            'iso639_2' => 'Iso639 2',
            'name' => 'Name',
            'nativeName' => 'Native Name',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
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
