<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPostImagesMaster;

/**
* This is the model class for table "product_post_images".
*
    * @property string $imagesId
    * @property string $productPostId
    * @property string $picture
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductPostImages extends \common\models\costfit\master\ProductPostImagesMaster{
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
