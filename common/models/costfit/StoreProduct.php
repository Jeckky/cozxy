<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\StoreProductMaster;

/**
* This is the model class for table "store_product".
*
* @property string $storeProductId
* @property string $storeProductGroupId
* @property string $storeId
* @property string $productId
* @property string $paletNo
* @property string $quantity
* @property string $price
* @property string $total
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*
* @property Product $product
* @property StoreProductGroup $storeProductGroup
* @property Store $store
* @property StoreProductOrderItem[] $storeProductOrderItems
*/

class StoreProduct extends \common\models\costfit\master\StoreProductMaster{
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
