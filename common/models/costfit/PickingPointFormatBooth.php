<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PickingPointFormatBoothMaster;

/**
* This is the model class for table "picking_point_format_booth".
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

class PickingPointFormatBooth extends \common\models\costfit\master\PickingPointFormatBoothMaster{
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
