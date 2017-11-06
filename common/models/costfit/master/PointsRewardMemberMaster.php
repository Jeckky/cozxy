<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "points_reward_member".
*
    * @property integer $pointsMemberId
    * @property integer $rankId
    * @property integer $userId
    * @property integer $orderId
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
            [['rankId', 'userId', 'orderId', 'status'], 'integer'],
            [['createDateTime'], 'required'],
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
