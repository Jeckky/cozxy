<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\AuthItemChildMaster;

/**
* This is the model class for table "auth_item_child".
*
    * @property string $parent
    * @property string $child
    *
            * @property AuthItem $parent0
            * @property AuthItem $child0
    */

class AuthItemChild extends \common\models\costfit\master\AuthItemChildMaster{
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
