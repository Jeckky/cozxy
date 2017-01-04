<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "_temp_amphur".
*
    * @property string $amphurId
    * @property string $amphurCode
    * @property string $amphurName
    * @property integer $geographyId
    * @property integer $provinceId
*/
class TempAmphurMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return '_temp_amphur';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['amphurCode', 'amphurName'], 'required'],
            [['geographyId', 'provinceId'], 'integer'],
            [['amphurCode'], 'string', 'max' => 45],
            [['amphurName'], 'string', 'max' => 150],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'amphurId' => Yii::t('_temp_amphur', 'Amphur ID'),
    'amphurCode' => Yii::t('_temp_amphur', 'Amphur Code'),
    'amphurName' => Yii::t('_temp_amphur', 'Amphur Name'),
    'geographyId' => Yii::t('_temp_amphur', 'Geography ID'),
    'provinceId' => Yii::t('_temp_amphur', 'Province ID'),
];
}
}
