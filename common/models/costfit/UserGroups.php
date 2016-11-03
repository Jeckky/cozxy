<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserGroupsMaster;

/**
* This is the model class for table "user_groups".
*
    * @property integer $user_group_Id
    * @property string $name
    * @property integer $parent_id
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class UserGroups extends \common\models\costfit\master\UserGroupsMaster{
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
