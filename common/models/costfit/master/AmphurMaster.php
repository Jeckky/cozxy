<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "amphur".
*
    * @property string $amphurId
    * @property string $amphurCode
    * @property string $amphurName
    * @property integer $geographyId
    * @property integer $provinceId
*/
class AmphurMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'amphur';
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
    'amphurId' => Yii::t('amphur', 'Amphur ID'),
    'amphurCode' => Yii::t('amphur', 'Amphur Code'),
    'amphurName' => Yii::t('amphur', 'Amphur Name'),
    'geographyId' => Yii::t('amphur', 'Geography ID'),
    'provinceId' => Yii::t('amphur', 'Province ID'),
];
}
}
