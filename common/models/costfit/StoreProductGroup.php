<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\StoreProductGroupMaster;

/**
 * This is the model class for table "store_product_group".
 *
 * @property string $storeProductGroupId
 * @property string $supplierId
 * @property string $poNo
 * @property string $title
 * @property string $description
 * @property string $summary
 * @property string $receiveDate
 * @property integer $receiveBy
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property StoreProduct[] $storeProducts
 * @property Supplier $supplier
 */
class StoreProductGroup extends \common\models\costfit\master\StoreProductGroupMaster {

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
        return array_merge(parent::attributeLabels(), []);
    }

    public function getSupplierName() {
        return $this->hasOne(Supplier::className(), ['supplierId' => 'supplierId']);
    }

    public function getStoreProducts() {
        return $this->hasMany(StoreProduct::className(), ['storeProductGroupId' => 'storeProductGroupId']);
    }

}
