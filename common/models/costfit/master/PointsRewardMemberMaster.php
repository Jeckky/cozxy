<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "points_reward_member".
*
    * @property string $pointsMemberId
    * @property string $rankId
    * @property string $userId
    * @property string $orderId
    * @property integer $status
    * @property string $createBy
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PointsRewardMemberMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'points_reward_member';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['pointsMemberId', 'createDateTime'], 'required'],
            [['pointsMemberId', 'rankId', 'userId', 'orderId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['createBy'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pointsMemberId' => Yii::t('points_reward_member', 'Points Member ID'),
    'rankId' => Yii::t('points_reward_member', 'Rank ID'),
    'userId' => Yii::t('points_reward_member', 'User ID'),
    'orderId' => Yii::t('points_reward_member', 'Order ID'),
    'status' => Yii::t('points_reward_member', 'Status'),
    'createBy' => Yii::t('points_reward_member', 'Create By'),
    'createDateTime' => Yii::t('points_reward_member', 'Create Date Time'),
    'updateDateTime' => Yii::t('points_reward_member', 'Update Date Time'),
];
}
}
