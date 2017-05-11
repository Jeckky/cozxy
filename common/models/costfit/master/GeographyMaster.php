<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "geography".
*
    * @property string $geographyId
    * @property string $name
    * @property string $nameEn
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
    * @return \yii\db\Connection the database connection used by this AR class.
    */
    public static function getDb()
    {
    return Yii::$app->get('dbWorld');
    }

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['name', 'nameEn'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'geographyId' => Yii::t('geography', 'Geography ID'),
    'name' => Yii::t('geography', 'Name'),
    'nameEn' => Yii::t('geography', 'Name En'),
];
}
}
