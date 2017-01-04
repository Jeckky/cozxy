<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserRewardUsedMaster;

/**
* This is the model class for table "user_reward_used".
*
    * @property string $id
    * @property string $userRewardId
    * @property string $orderId
    * @property integer $usedPoints
    * @property string $createDateTime
*/

class UserRewardUsed extends \common\models\costfit\master\UserRewardUsedMaster{
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
