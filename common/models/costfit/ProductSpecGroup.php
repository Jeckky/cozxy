<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductSpecGroupMaster;

/**
* This is the model class for table "product_spec_group".
*
    * @property string $productSpecGroupId
    * @property string $productId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $parentId
    * @property integer $type
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductSpecGroup extends \common\models\costfit\master\ProductSpecGroupMaster{
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
