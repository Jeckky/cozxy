<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\StoreLocationMaster;

/**
 * This is the model class for table "store_location".
 *
 * @property string $storeLocationId
 * @property string $storeId
 * @property integer $provinceId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property Store $store
 */
class StoreLocation extends \common\models\costfit\master\StoreLocationMaster
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

    public function getState()
    {
        return $this->hasOne(\common\models\dbworld\States::className(), ['stateId' => 'provinceId']);
    }

}
