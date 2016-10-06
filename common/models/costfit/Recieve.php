<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\RecieveMaster;

/**
* This is the model class for table "recieve".
*
    * @property string $recieveId
    * @property string $orderId
    * @property string $userId
    * @property string $pickingId
    * @property string $password
    * @property integer $isUse
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Recieve extends \common\models\costfit\master\RecieveMaster{
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
