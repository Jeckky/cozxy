<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_reward_used".
*
    * @property string $id
    * @property string $userRewardId
    * @property string $orderId
    * @property integer $usedPoints
    * @property string $createDateTime
*/
class UserRewardUsedMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_reward_used';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userRewardId', 'orderId', 'usedPoints'], 'required'],
            [['userRewardId', 'orderId', 'usedPoints'], 'integer'],
            [['createDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('user_reward_used', 'ID'),
    'userRewardId' => Yii::t('user_reward_used', 'User Reward ID'),
    'orderId' => Yii::t('user_reward_used', 'Order ID'),
    'usedPoints' => Yii::t('user_reward_used', 'Used Points'),
    'createDateTime' => Yii::t('user_reward_used', 'Create Date Time'),
];
}
}
