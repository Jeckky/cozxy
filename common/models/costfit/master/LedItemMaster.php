<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "led_item".
*
    * @property string $ledItemId
    * @property integer $ledId
    * @property integer $color
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class LedItemMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'led_item';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['ledId'], 'required'],
            [['ledId', 'color', 'sortOrder', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'ledItemId' => Yii::t('led_item', 'Led Item ID'),
    'ledId' => Yii::t('led_item', 'Led ID'),
    'color' => Yii::t('led_item', 'Color'),
    'sortOrder' => Yii::t('led_item', 'Sort Order'),
    'status' => Yii::t('led_item', 'Status'),
    'createDateTime' => Yii::t('led_item', 'Create Date Time'),
    'updateDateTime' => Yii::t('led_item', 'Update Date Time'),
];
}
}
