<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\NotificationsMaster;

/**
* This is the model class for table "notifications".
*
    * @property string $notiId
    * @property string $id
    * @property string $title
    * @property string $type
    * @property integer $status
    * @property string $parentId
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Notifications extends \common\models\costfit\master\NotificationsMaster{
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
