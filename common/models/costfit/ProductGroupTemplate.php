<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductGroupTemplateMaster;

/**
* This is the model class for table "product_group_template".
*
    * @property string $productGroupTemplateId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Product[] $products
            * @property ProductGroupTemplateOption[] $productGroupTemplateOptions
    */

class ProductGroupTemplate extends \common\models\costfit\master\ProductGroupTemplateMaster{
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
