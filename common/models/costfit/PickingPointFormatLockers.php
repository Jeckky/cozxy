<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PickingPointFormatLockersMaster;

/**
* This is the model class for table "picking_point_format_lockers".
*
    * @property string $pickingItemsId
    * @property string $code
    * @property string $name
    * @property string $portIndex
    * @property integer $height
    * @property string $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class PickingPointFormatLockers extends \common\models\costfit\master\PickingPointFormatLockersMaster{
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
