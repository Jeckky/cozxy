<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PointsRewardMemberMaster;

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

class PointsRewardMember extends \common\models\costfit\master\PointsRewardMemberMaster{
/**
* @inheritdoc
*/
public function rules()
{
return array_merge(parent::rules(), []);
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return array_merge(parent::attributeLabels(), []);
}
}
