<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\SubscribeMaster;

/**
* This is the model class for table "subscribe".
*
    * @property string $subscribe Id
    * @property string $email
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Subscribe extends \common\models\costfit\master\SubscribeMaster{
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
