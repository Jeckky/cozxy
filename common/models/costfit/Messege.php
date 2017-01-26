<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\MessegeMaster;

/**
* This is the model class for table "messege".
*
    * @property string $messegeId
    * @property integer $ticketId
    * @property integer $orderId
    * @property integer $userId
    * @property integer $messegeType
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Messege extends \common\models\costfit\master\MessegeMaster{
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
