<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PoItemMaster;

/**
* This is the model class for table "po_item".
*
    * @property string $poItemId
    * @property string $poId
    * @property string $storeId
    * @property string $productId
    * @property integer $productSuppId
    * @property string $paletNo
    * @property integer $quantity
    * @property string $price
    * @property string $marginPercent
    * @property string $marginValue
    * @property string $marginPrice
    * @property string $total
    * @property integer $shippingFromType
    * @property integer $importQuantity
    * @property string $remark
    * @property string $orderItemId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class PoItem extends \common\models\costfit\master\PoItemMaster{
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
