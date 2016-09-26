<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\StorePickingMaster;

/**
* This is the model class for table "store_picking".
*
    * @property integer $storePickingId
    * @property integer $pickerId
    * @property string $orderId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class StorePicking extends \common\models\costfit\master\StorePickingMaster{
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
