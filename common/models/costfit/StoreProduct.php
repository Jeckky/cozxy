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
class StoreProduct extends \common\models\costfit\master\StoreProductMaster {

    const SHIPPING_FROM_TYPE_COSTFIT = 1;
    const SHIPPING_FROM_TYPE_SUPPLIER_TO_COSTFIT = 2;
    const SHIPPING_FROM_TYPE_SUPPLIER = 3;

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
            'quantity' => 'จำนวน',
            'price' => 'ราคา',
            'productId' => 'สินค้า',
            'storeId' => 'คลังสินค้า',
            'storeProductGroupId' => 'PO',
            'shippingFromType' => 'วิธีการจัดส่ง',
        ]);
    }

    public function findAllShippingFromTypeArray() {
        return [
            self::SHIPPING_FROM_TYPE_COSTFIT => "ส่งจาก costfit",
            self::SHIPPING_FROM_TYPE_SUPPLIER_TO_COSTFIT => "รับจาก Supplier ส่งจาก costfit",
            self::SHIPPING_FROM_TYPE_SUPPLIER => "ส่งจาก Supplier",
        ];
    }

    public function getShippingFromTypeText($type) {
        $res = $this->findAllShippingTypeFromArray();
        if (isset($res[$type])) {
            return $res[$type];
        } else {
            return NULL;
        }
    }

    public function getStores() {

        return $this->hasOne(Store::className(), ['storeId' => 'storeId']);
    }

}
