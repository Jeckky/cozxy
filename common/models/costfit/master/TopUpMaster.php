<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "top_up".
*
    * @property string $topUpId
    * @property string $userId
    * @property string $money
    * @property string $point
    * @property integer $paymentMethod
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class TopUpMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'top_up';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'money', 'point', 'paymentMethod', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'topUpId' => Yii::t('top_up', 'Top Up ID'),
    'userId' => Yii::t('top_up', 'User ID'),
    'money' => Yii::t('top_up', 'Money'),
    'point' => Yii::t('top_up', 'Point'),
    'paymentMethod' => Yii::t('top_up', 'Payment Method'),
    'status' => Yii::t('top_up', 'Status'),
    'createDateTime' => Yii::t('top_up', 'Create Date Time'),
    'updateDateTime' => Yii::t('top_up', 'Update Date Time'),
];
}
}
