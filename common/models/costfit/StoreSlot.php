<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\StoreSlotMaster;

/**
* This is the model class for table "store_slot".
*
* @property string $storeSlotId
* @property string $storeId
* @property string $code
* @property string $title
* @property string $description
* @property string $width
* @property string $height
* @property string $depth
* @property string $weight
* @property string $maxWeight
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*
* @property Store $store
*/

class StoreSlot extends \common\models\costfit\master\StoreSlotMaster{
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
