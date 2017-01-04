<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\BrandModelImageMaster;

/**
* This is the model class for table "brand_model_image".
*
    * @property string $brandModelImageId
    * @property string $brandModelId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class BrandModelImage extends \common\models\costfit\master\BrandModelImageMaster{
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
