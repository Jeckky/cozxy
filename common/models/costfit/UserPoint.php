<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserPointMaster;

/**
* This is the model class for table "user_point".
*
    * @property string $userPointId
    * @property integer $currentPoint
    * @property integer $totalPoint
    * @property integer $totalMoney
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class UserPoint extends \common\models\costfit\master\UserPointMaster{
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
