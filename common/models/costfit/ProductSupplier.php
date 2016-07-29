<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductSupplierMaster;

/**
* This is the model class for table "product_supplier".
*
    * @property string $productSupplierId
    * @property string $productId
    * @property string $supplierId
    * @property string $leaseTime
    * @property string $maxQuantity
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDatetime
*/

class ProductSupplier extends \common\models\costfit\master\ProductSupplierMaster{
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
