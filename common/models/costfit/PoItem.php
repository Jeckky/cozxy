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
class PoItem extends \common\models\costfit\master\PoItemMaster {

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

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'code', 'title', 'result', 'unit'
        ]);
    }

    public function findAllStatusArray() {
        return [
            self::STATUS_IMPORT => "นำข้อมูลเข้า",
            self::STATUS_QC => "ตรวจและนับแล้ว", //import แล้ว
            self::STATUS_ARRANGED_SOME => "จัดเรียงบางส่วนแล้ว",
            self::STATUS_ARRANGED => "จัดเรียงทั้งหมดแล้ว",
            self::STATUS_ARRANGING => "กำลังนำไปจัดเรียง",
        ];
    }

    public function getStatusText($status) {
        $res = $this->findAllStatusArray();
        if (isset($res[$status])) {
            return $res[$status];
        } else {
            return NULL;
        }
    }

    public function getStores() {
        return $this->hasOne(Store::className(), ['storeId' => 'storeId']);
    }

    public function getProducts() {
        return $this->hasOne(ProductSuppliers::className(), ['productSuppId' => 'productSuppId']);
    }

    public static function createStatus($productSuppId, $poId) {
        $all = 0;
        $some = 0;
        $noSome = 0;
        $no = 0;
        $text = '';
        $poItems = PoItem::find()->where("productSuppId=" . $productSuppId . " and poId in (" . $poId . ")")->all();
        foreach ($poItems as $product):
            if ($product->status == 4) {
                $all++;
            }
            if ($product->status == 3) {
                $some++;
            }
            if ($product->status == 5) {
                $no++;
            }
        endforeach;
        if ($all > 0) {
            $poItems = PoItem::find()->where("productSuppId=" . $productSuppId . " and poId in (" . $poId . ")")->all();
            $hasNoArrange = false;
            foreach ($poItems as $product):
                if (($product->status == 3) || ($product->status == 5)) {
                    $hasNoArrange = true;
                }
            endforeach;
            if ($hasNoArrange == true) {
                $text = 'จัดเรียงแล้วบางส่วน';
            } else {
                $text = 'จัดเรียงแล้วทั้งหมด';
            }
        }
        if ($some > 0) {
            $text = 'จัดเรียงแล้วบางส่วน';
        }
        if ($no > 0 && $all == 0 && $some == 0) {
            $text = 'กำลังนำไปจัดเรียง';
        }
        return $text;
    }

    public static function quantity($productSuppId, $poId) {
        $sum = 0;
        //$storeProduct = StoreProduct::find()->where("productId=" . $productId . " and storeProductGroupId in (" . $storeProductGroupId . ")")->all();
        $poItems = PoItem::find()->where("productSuppId=" . $productSuppId . " and poId in (" . $poId . ")")->all();
        if (isset($poItems) && count($poItems) > 0) {
            foreach ($poItems as $product):
                $sum += $product->importQuantity;
            endforeach;
        }
        return $sum;
    }

}
