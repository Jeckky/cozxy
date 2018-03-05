<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\Language as LanguageModel;
use \common\models\worlddb\query\LanguageQuery;
/**
* This is the model class for table "language".
*
* @property string $languageId
* @property string $iso639_1
* @property string $iso639_2
* @property string $name
* @property string $nativeName
* @property integer $createDateTime
* @property integer $updateDateTime
* @property integer $countryId
*
* @property Country $country
*/

class Language extends LanguageModel
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
    * @return \common\models\worlddb\query\LanguageQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new LanguageQuery(get_called_class());
    }
}
