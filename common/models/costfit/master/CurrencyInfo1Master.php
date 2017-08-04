<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "currency_info1".
*
    * @property string $title
    * @property string $title1
    * @property string $title2
*/
class CurrencyInfo1Master extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'currency_info1';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title', 'title1', 'title2'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'title' => Yii::t('currency_info1', 'Title'),
    'title1' => Yii::t('currency_info1', 'Title1'),
    'title2' => Yii::t('currency_info1', 'Title2'),
];
}
}
