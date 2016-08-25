<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductHotMaster;

/**
* This is the model class for table "product_hot".
*
    * @property string $productHotId
    * @property string $productId
    * @property string $price
    * @property string $startDate
    * @property string $endDate
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductHot extends \common\models\costfit\master\ProductHotMaster{
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
