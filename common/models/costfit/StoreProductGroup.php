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
    const STATUS_IMPORT_DATA = 1;
    const STATUS_QC = 2; //QC
    const STATUS_ARRANGED_SOME = 3;
    const STATUS_ARRANGED = 4;

    public static function findAllStatusArray() {
        return [
            self::STATUS_IMPORT_DATA => "นำข้อมูลเข้า",
            self::STATUS_QC => "ตรวจรับแล้ว", //import แล้ว
            self::STATUS_ARRANGED_SOME => "เรียงบางส่วนแล้ว",
            self::STATUS_ARRANGED => "เรียงทั้งหมดแล้ว",
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
            'isbn'
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

    public function getStoreProducts() {
        return $this->hasMany(StoreProduct::className(), ['storeProductGroupId' => 'storeProductGroupId'])->orderBy("status");
    }

    public function checkPo($id) {
        $checkPo = StoreProductGroup::find()->where("storeProductGroupId='" . $id . "' and status!=3")->all();
        if (count($checkPo) == 0) {
            $this->redirect(['store-product-group/index']);
        }
    }

}
