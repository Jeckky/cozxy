<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductGroupCategoryMaster;

/**
* This is the model class for table "product_group_category".
*
    * @property string $productGroupCategoryId
    * @property string $categoryId
    * @property string $productGroupId
    *
            * @property Category $category
            * @property Product $productGroup
    */

class ProductGroupCategory extends \common\models\costfit\master\ProductGroupCategoryMaster{
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
