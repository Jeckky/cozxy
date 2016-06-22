<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\SupplierProductMaster;

/**
* This is the model class for table "supplier_product".
*
    * @property string $supplierProductId
    * @property string $supplierId
    * @property string $productId
    * @property integer $leaseTime
    * @property string $maxQuantity
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class SupplierProduct extends \common\models\costfit\master\SupplierProductMaster{
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
