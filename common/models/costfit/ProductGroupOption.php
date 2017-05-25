<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductGroupOptionMaster;

/**
* This is the model class for table "product_group_option".
*
    * @property string $productGroupOptionId
    * @property string $productGroupId
    * @property string $productGroupTemplateOptionId
    * @property string $name
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property ProductGroupTemplateOption $productGroupTemplateOption
            * @property Product $productGroup
            * @property ProductGroupOptionValue[] $productGroupOptionValues
            * @property ProductSuppliersOption[] $productSuppliersOptions
    */

class ProductGroupOption extends \common\models\costfit\master\ProductGroupOptionMaster{
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
