<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductSupplierMaster;

/**

 * This is the model class for table "product_supplier".
 *
 * @property integer $productSupplierId
 * @property integer $productId
 * @property integer $supplierId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDatetime
 */
class ProductSupplier extends \common\models\costfit\master\ProductSupplierMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'productId' => 'Product',
            'supplierId' => 'Supplier',
            'leaseTime' => 'Lease Time (Day)',
            'maxQuantity' => 'Max Quantity (Unit)'
        ]);
    }

    public function getProducts() {

        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    public function getSuppliers() {
        //throw new \yii\base\Exception($this->productId);
        return $this->hasOne(Supplier::className(), ['supplierId' => 'supplierId']);
    }

}
