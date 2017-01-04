<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "geography".
*
    * @property integer $geographyId
    * @property string $geographyName
*/
class GeographyMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'geography';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['geographyName'], 'required'],
            [['geographyName'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'geographyId' => Yii::t('geography', 'Geography ID'),
    'geographyName' => Yii::t('geography', 'Geography Name'),
];
}
}
