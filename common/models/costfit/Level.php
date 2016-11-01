<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\LevelMaster;

/**
* This is the model class for table "level".
*
    * @property string $levelId
    * @property string $name
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Level extends \common\models\costfit\master\LevelMaster{
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
