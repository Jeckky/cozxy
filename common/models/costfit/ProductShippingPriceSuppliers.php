<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductShippingPriceSuppliersMaster;

/**
* This is the model class for table "product_shipping_price_suppliers".
*
    * @property string $productShippingPriceId
    * @property string $productId
    * @property string $shippingTypeId
    * @property string $date
    * @property string $discount
    * @property string $type
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductShippingPriceSuppliers extends \common\models\costfit\master\ProductShippingPriceSuppliersMaster{
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
