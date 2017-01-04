<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductSpecMaster;

/**
* This is the model class for table "product_spec".
*
    * @property string $productSpecId
    * @property string $productSpecGroupId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $videoEmbeded
    * @property integer $sortOrder
    * @property integer $spanWidth
    * @property integer $showTitleType
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductSpec extends \common\models\costfit\master\ProductSpecMaster{
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
