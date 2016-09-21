<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PickingsMaster;

/**
* This is the model class for table "pickings".
*
    * @property integer $pickingsId
    * @property integer $pickingId
    * @property string $userId
    * @property string $status
    * @property string $isDefault
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Pickings extends \common\models\costfit\master\PickingsMaster{
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
