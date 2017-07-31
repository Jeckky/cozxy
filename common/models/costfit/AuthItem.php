<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\AuthItemMaster;

/**
* This is the model class for table "auth_item".
*
    * @property string $name
    * @property integer $type
    * @property string $description
    * @property string $rule_name
    * @property resource $data
    * @property integer $created_at
    * @property integer $updated_at
    *
            * @property AuthAssignment[] $authAssignments
            * @property AuthRule $ruleName
            * @property AuthItemChild[] $authItemChildren
            * @property AuthItemChild[] $authItemChildren0
            * @property AuthItem[] $children
            * @property AuthItem[] $parents
    */

class AuthItem extends \common\models\costfit\master\AuthItemMaster{
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
