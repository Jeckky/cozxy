<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\BrandImageMaster;

/**
* This is the model class for table "brand_image".
*
    * @property string $brandImageId
    * @property string $brandId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Brand $brand
    */

class BrandImage extends \common\models\costfit\master\BrandImageMaster{
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
