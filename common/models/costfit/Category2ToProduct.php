<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\Category2ToProductMaster;

/**
* This is the model class for table "category2_to_product".
*
    * @property string $id
    * @property string $brandId
    * @property string $brandModelId
    * @property string $category1Id
    * @property string $category2Id
    * @property string $productId
    * @property string $groupName
    * @property integer $quantity
    * @property integer $type
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Category2ToProduct extends \common\models\costfit\master\Category2ToProductMaster{
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
