<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\SupplierDiscountRangeMaster;

/**
* This is the model class for table "supplier_discount_range".
*
    * @property string $id
    * @property string $supplierId
    * @property string $min
    * @property string $max
    * @property integer $percentDiscount
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Supplier $supplier
    */

class SupplierDiscountRange extends \common\models\costfit\master\SupplierDiscountRangeMaster{
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
