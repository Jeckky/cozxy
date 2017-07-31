<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\RouteMaster;

/**
* This is the model class for table "route".
*
    * @property string $name
    * @property string $alias
    * @property string $type
    * @property integer $status
*/

class Route extends \common\models\costfit\master\RouteMaster{
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
