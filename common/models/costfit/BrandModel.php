<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\BrandModelMaster;

/**
* This is the model class for table "brand_model".
*
    * @property string $brandModelId
    * @property string $brandId
    * @property string $supplierId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class BrandModel extends \common\models\costfit\master\BrandModelMaster{
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
