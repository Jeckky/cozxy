<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPageViewsMaster;

/**
* This is the model class for table "product_page_views".
*
    * @property string $viewId
    * @property string $productSuppId
    * @property string $userId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductPageViews extends \common\models\costfit\master\ProductPageViewsMaster{
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
