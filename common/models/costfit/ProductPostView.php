<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPostViewMaster;

/**
* This is the model class for table "product_post_view".
*
    * @property string $productPostViewId
    * @property string $productPostId
    * @property string $userId
    * @property string $token
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductPostView extends \common\models\costfit\master\ProductPostViewMaster{
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
