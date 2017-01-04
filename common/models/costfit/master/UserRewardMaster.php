<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_reward".
*
    * @property string $userRewardId
    * @property string $userId
    * @property string $orderId
    * @property string $description
    * @property integer $points
    * @property integer $remainingPoints
    * @property integer $status
    * @property string $expiredDate
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserRewardMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_reward';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'orderId', 'points', 'remainingPoints', 'expiredDate'], 'required'],
            [['userId', 'orderId', 'points', 'remainingPoints', 'status'], 'integer'],
            [['description'], 'string'],
            [['expiredDate', 'createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userRewardId' => Yii::t('user_reward', 'User Reward ID'),
    'userId' => Yii::t('user_reward', 'User ID'),
    'orderId' => Yii::t('user_reward', 'Order ID'),
    'description' => Yii::t('user_reward', 'Description'),
    'points' => Yii::t('user_reward', 'Points'),
    'remainingPoints' => Yii::t('user_reward', 'Remaining Points'),
    'status' => Yii::t('user_reward', 'Status'),
    'expiredDate' => Yii::t('user_reward', 'Expired Date'),
    'createDateTime' => Yii::t('user_reward', 'Create Date Time'),
    'updateDateTime' => Yii::t('user_reward', 'Update Date Time'),
];
}
}
