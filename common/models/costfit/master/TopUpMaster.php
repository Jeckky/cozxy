<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "top_up".
*
    * @property string $topUpId
    * @property integer $userId
    * @property integer $money
    * @property integer $point
    * @property integer $paymentMethod
    * @property string $image
    * @property string $topUpNo
    * @property integer $isFromCheckout
    * @property string $resultCode
    * @property string $resultMessageEn
    * @property string $resultMessageTh
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
            [['userId', 'money', 'point', 'paymentMethod', 'isFromCheckout', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['image', 'resultMessageEn', 'resultMessageTh'], 'string', 'max' => 255],
            [['topUpNo'], 'string', 'max' => 13],
            [['resultCode'], 'string', 'max' => 5],
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
    'image' => Yii::t('top_up', 'Image'),
    'topUpNo' => Yii::t('top_up', 'Top Up No'),
    'isFromCheckout' => Yii::t('top_up', 'Is From Checkout'),
    'resultCode' => Yii::t('top_up', 'Result Code'),
    'resultMessageEn' => Yii::t('top_up', 'Result Message En'),
    'resultMessageTh' => Yii::t('top_up', 'Result Message Th'),
    'status' => Yii::t('top_up', 'Status'),
    'createDateTime' => Yii::t('top_up', 'Create Date Time'),
    'updateDateTime' => Yii::t('top_up', 'Update Date Time'),
];
}
}
