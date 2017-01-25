<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserCreditMaster;

/**
* This is the model class for table "user_credit".
*
    * @property string $userCreditId
    * @property integer $userId
    * @property integer $totalCredit
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class UserCredit extends \common\models\costfit\master\UserCreditMaster{
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
