<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\RegionMaster;

/**
* This is the model class for table "region".
*
* @property string $regionId
* @property string $title
* @property string $description
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*
* @property Store[] $stores
*/

class Region extends \common\models\costfit\master\RegionMaster{
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
