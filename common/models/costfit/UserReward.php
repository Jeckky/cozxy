<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserRewardMaster;

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

class UserReward extends \common\models\costfit\master\UserRewardMaster{
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
