<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "taninut".
*
    * @property integer $id
    * @property string $name
    * @property string $Taninutcol
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class TaninutMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'taninut';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['createDateTime'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name', 'Taninutcol'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('taninut', 'ID'),
    'name' => Yii::t('taninut', 'Name'),
    'Taninutcol' => Yii::t('taninut', 'Taninutcol'),
    'createDateTime' => Yii::t('taninut', 'Create Date Time'),
    'updateDateTime' => Yii::t('taninut', 'Update Date Time'),
];
}
}
