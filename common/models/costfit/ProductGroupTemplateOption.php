<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductGroupTemplateOptionMaster;

/**
* This is the model class for table "product_group_template_option".
*
    * @property string $productGroupTemplateOptionId
    * @property string $productGroupTemplateId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property ProductGroupOption[] $productGroupOptions
            * @property ProductGroupTemplate $productGroupTemplate
            * @property ProductSuppliersOption[] $productSuppliersOptions
    */

class ProductGroupTemplateOption extends \common\models\costfit\master\ProductGroupTemplateOptionMaster{
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
