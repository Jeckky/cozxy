<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPriceOtherWebMaster;

/**
* This is the model class for table "product_price_other_web".
*
    * @property string $productPriceOtherWebId
    * @property string $productId
    * @property string $webId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductPriceOtherWeb extends \common\models\costfit\master\ProductPriceOtherWebMaster{
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
