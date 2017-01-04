<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductOptionMaster;

/**
* This is the model class for table "product_option".
*
    * @property string $productOptionId
    * @property string $productOptionGroupId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $priceValue
    * @property string $pricePercent
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductOption extends \common\models\costfit\master\ProductOptionMaster{
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
