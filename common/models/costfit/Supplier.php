<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\SupplierMaster;

/**
* This is the model class for table "supplier".
*
* @property string $supplierId
* @property string $name
* @property string $address
* @property string $description
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*
* @property StoreProductGroup[] $storeProductGroups
*/

class Supplier extends \common\models\costfit\master\SupplierMaster{
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
