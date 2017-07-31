<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\AuthAssignmentMaster;

/**
* This is the model class for table "auth_assignment".
*
    * @property string $item_name
    * @property string $user_id
    * @property integer $created_at
    *
            * @property AuthItem $itemName
    */

class AuthAssignment extends \common\models\costfit\master\AuthAssignmentMaster{
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
