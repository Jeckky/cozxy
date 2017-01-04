<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductOptionGroupMaster;

/**
* This is the model class for table "product_option_group".
*
    * @property string $productOptionGroupId
    * @property string $productId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductOptionGroup extends \common\models\costfit\master\ProductOptionGroupMaster{
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
