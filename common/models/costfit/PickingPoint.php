<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PickingPointMaster;

/**
* This is the model class for table "picking_point".
*
    * @property integer $pickingId
    * @property string $userId
    * @property string $title
    * @property string $countryId
    * @property string $provinceId
    * @property string $amphurId
    * @property integer $status
    * @property integer $type
    * @property integer $isDefault
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class PickingPoint extends \common\models\costfit\master\PickingPointMaster{
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
