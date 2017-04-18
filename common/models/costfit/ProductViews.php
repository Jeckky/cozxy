<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductViewsMaster;

/**
* This is the model class for table "product_views".
*
    * @property string $viewId
    * @property string $productSuppId
    * @property string $userId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductViews extends \common\models\costfit\master\ProductViewsMaster{
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
