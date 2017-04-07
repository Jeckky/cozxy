<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPostMaster;

/**
* This is the model class for table "product_post".
*
    * @property string $productPostId
    * @property string $productSuppId
    * @property string $brandId
    * @property string $userId
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductPost extends \common\models\costfit\master\ProductPostMaster{
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
