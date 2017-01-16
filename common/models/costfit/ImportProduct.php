<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ImportProductMaster;

/**
* This is the model class for table "import_product".
*
    * @property string $productId
    * @property string $userId
    * @property string $productGroupId
    * @property string $brandId
    * @property string $categoryId
    * @property string $isbn
    * @property string $code
    * @property string $title
    * @property string $optionName
    * @property string $shortDescription
    * @property string $description
    * @property string $specification
    * @property string $width
    * @property string $height
    * @property string $depth
    * @property string $weight
    * @property string $price
    * @property string $unit
    * @property string $smallUnit
    * @property string $tags
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $approve
    * @property string $productSuppId
    * @property string $approveCreateBy
    * @property string $approvecreateDateTime
*/

class ImportProduct extends \common\models\costfit\master\ImportProductMaster{
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
