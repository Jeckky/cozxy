<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "points_reward_rank".
*
    * @property integer $rankId
    * @property string $num1
    * @property string $num2
    * @property string $cash
    * @property string $points
    * @property integer $status
    * @property string $createBy
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PointsRewardRankMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'points_reward_rank';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['num1', 'num2'], 'number'],
            [['status'], 'integer'],
            [['createDateTime'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['cash', 'points', 'createBy'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'rankId' => Yii::t('points_reward_rank', 'Rank ID'),
    'num1' => Yii::t('points_reward_rank', 'Num1'),
    'num2' => Yii::t('points_reward_rank', 'Num2'),
    'cash' => Yii::t('points_reward_rank', 'Cash'),
    'points' => Yii::t('points_reward_rank', 'Points'),
    'status' => Yii::t('points_reward_rank', 'Status'),
    'createBy' => Yii::t('points_reward_rank', 'Create By'),
    'createDateTime' => Yii::t('points_reward_rank', 'Create Date Time'),
    'updateDateTime' => Yii::t('points_reward_rank', 'Update Date Time'),
];
}
}
