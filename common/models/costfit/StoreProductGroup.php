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
    const STATUS_DRAFT = 0; // แบบร่าง
    const STATUS_IMPORT_DATA = 1;
    const STATUS_QC = 2; //QC
    const STATUS_ARRANGED_SOME = 3;
    const STATUS_ARRANGED = 4;
    const STATUS_ARRANGING = 5;
    const STATUS_PURCHASING = 6; // ส่งสั่งซื้อ

    public static function findAllStatusArray() {
        return [
            self::STATUS_DRAFT => "สร้าง",
            self::STATUS_PURCHASING => 'กำลังสั่งซื้อ',
            self::STATUS_IMPORT_DATA => "นำข้อมูลเข้า",
            self::STATUS_QC => "ตรวจรับแล้ว", //import แล้ว
            self::STATUS_ARRANGING => "กำลังนำไปจัดเรียง",
            self::STATUS_ARRANGED_SOME => "จัดเรียงบางส่วนแล้ว",
            self::STATUS_ARRANGED => "จัดเรียงทั้งหมดแล้ว",
        ];
    }

    public static function getStatusText($status) {
        $res = StoreProductGroup::findAllStatusArray();
        if (isset($res[$status])) {
            return $res[$status];
        } else {
            return NULL;
        }
    }

    public static function findPoNo($storeProductGroupId) {
        $po = StoreProductGroup::find()->where("storeProductGroupId=" . $storeProductGroupId)->one();
        if (isset($po) && !empty($po)) {
            return $po->poNo;
        } else {
            return '';
        }
    }

    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'isbn',
            'maxCode'
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function countProducts($storeProgroupId) {
        $storeProduct = count(StoreProduct::find()->where("storeProductGroupId=" . $storeProgroupId)->all());
        return $storeProduct;
    }

    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getSupplierName() {
        return $this->hasOne(Supplier::className(), ['supplierId' => 'supplierId']);
    }

    public function getSupplierAddress() {
        return $this->hasOne(Address::className(), ['userId' => 'supplierId']);
    }

    public function getStoreProducts() {
        return $this->hasMany(StoreProduct::className(), ['storeProductGroupId' => 'storeProductGroupId'])->orderBy("status");
    }

    public function checkPo($id) {
        $checkPo = StoreProductGroup::find()->where("storeProductGroupId='" . $id . "' and status!=3")->all();
        if (count($checkPo) == 0) {
            $this->redirect(['store-product-group/index']);
        }
    }

    public static function genPoNo($supplierId = null) {
        $prefix = 'PO'; //$supplierModel->prefix;

        $max_code = intval(\common\models\costfit\StoreProductGroup::findMaxPoNo($prefix));
        $max_code += 1;
        return $prefix . date("Ym") . "-" . str_pad($max_code, 6, "0", STR_PAD_LEFT);
    }

    public static function poNo($storeProductGroupId) {
        $po = StoreProductGroup::find()->where("storeProductGroupId=" . $storeProductGroupId)->one();
        if (isset($po) && !empty($po)) {
            return $po->poNo;
        } else {
            return 'Not Found';
        }
    }

    public static function allPurchaseOrder() {
        $all = StoreProductGroup::find()
                ->orderBy("poNo DESC")
                ->all();
        if (isset($all) && !empty($all)) {
            return $all;
        } else {
            return NULL;
        }
    }

    public static function findMaxPoNo($prefix = NULL) {
        $order = Order::findBySql("SELECT MAX(RIGHT(poNo,6)) as maxCode from `store_product_group` WHERE substr(poNo,1,2)='$prefix' order by poNo DESC ")->one();
//        $order = Order::find()->select("MAX(RIGHT(orderNo,7)) as maxCode")
//        ->where("substr(orderNo,1,2)='$prefix' ")
//        ->orderBy('orderNo DESC ')
//        ->max("maxCode");
//        ->one();

        return isset($order) ? $order->maxCode : 0;
    }

    public static function prouductGroup($id) {
        $storeProductGroup = StoreProductGroup::find()->where("storeProuductGroupId=" . $id)->one();
        return $storeProductGroup;
    }

}
