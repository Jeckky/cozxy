<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\AuthRuleMaster;

/**
* This is the model class for table "auth_rule".
*
    * @property string $name
    * @property resource $data
    * @property integer $created_at
    * @property integer $updated_at
    *
            * @property AuthItem[] $authItems
    */

class AuthRule extends \common\models\costfit\master\AuthRuleMaster{
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
