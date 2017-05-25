<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductSuppliersOptionMaster;

/**
* This is the model class for table "product_suppliers_option".
*
    * @property string $productSuppliersOptionId
    * @property string $productGroupOptionId
    * @property string $value
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $product_productId
    * @property string $productGroupTemplateOptionId
    *
            * @property ProductGroupOption $productGroupOption
            * @property Product $productProduct
            * @property ProductGroupTemplateOption $productGroupTemplateOption
    */

class ProductSuppliersOption extends \common\models\costfit\master\ProductSuppliersOptionMaster{
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
