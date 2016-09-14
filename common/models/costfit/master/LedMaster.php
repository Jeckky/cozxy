<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "led".
*
    * @property string $ledId
    * @property string $code
    * @property string $ip
    * @property string $shelf
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class LedMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'led';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['code', 'ip', 'createDateTime'], 'required'],
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['code', 'ip', 'shelf'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'ledId' => Yii::t('led', 'Led ID'),
    'code' => Yii::t('led', 'Code'),
    'ip' => Yii::t('led', 'Ip'),
    'shelf' => Yii::t('led', 'Shelf'),
    'status' => Yii::t('led', 'Status'),
    'createDateTime' => Yii::t('led', 'Create Date Time'),
    'updateDateTime' => Yii::t('led', 'Update Date Time'),
];
}
}
