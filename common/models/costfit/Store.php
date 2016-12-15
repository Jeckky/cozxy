<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\StoreMaster;

/**
 * This is the model class for table "store".
 *
 * @property string $storeId
 * @property string $regionId
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property Region $region
 * @property StoreLocation[] $storeLocations
 * @property StoreProduct[] $storeProducts
 * @property StoreSlot[] $storeSlots
 */
class Store extends \common\models\costfit\master\StoreMaster
{

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

    public function getRegion()
    {
        return $this->hasOne(\common\models\costfit\Region::className(), ['regionId' => 'regionId']);
    }

}
