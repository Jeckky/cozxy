<?php

namespace backend\modules\productmanager\models;;

use common\models\costfit\ProductPriceSuppliers;
use Yii;
use \common\models\costfit\ProductSuppliers as ProductSuppliersModel;

/**
 * This is the model class for table "product_suppliers".
 *
 * @property string $productSuppId
 * @property string $userId
 * @property string $brandId
 * @property string $categoryId
 * @property string $isbn
 * @property string $code
 * @property string $suppCode
 * @property string $merchantCode
 * @property string $title
 * @property string $optionName
 * @property string $shortDescription
 * @property string $description
 * @property string $specification
 * @property string $width
 * @property string $height
 * @property string $depth
 * @property string $weight
 * @property string $unit
 * @property string $smallUnit
 * @property string $tags
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $quantity
 * @property integer $result
 * @property string $approve
 * @property integer $productId
 * @property string $approveCreateBy
 * @property string $approvecreateDateTime
 * @property string $receiveType
 * @property string $url
 * @property integer $warrantyType
 * @property integer $warrantyPeriod
 */
class ProductSuppliers extends ProductSuppliersModel
{
    public $addStock;
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

    public function getProductPriceSuppliers()
    {
        return $this->hasOne(ProductPriceSuppliers::className(), ['productSuppId'=>'productSuppId'])->where(['status'=>1]);
    }

    public function getProduct() {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }
}
