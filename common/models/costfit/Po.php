<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PoMaster;

/**
 * This is the model class for table "po".
 *
 * @property string $poId
 * @property string $supplierId
 * @property string $poNo
 * @property string $summary
 * @property string $receiveDate
 * @property integer $receiveBy
 * @property integer $arranger
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Po extends \common\models\costfit\master\PoMaster {

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
        $res = Po::findAllStatusArray();
        if (isset($res[$status])) {
            return $res[$status];
        } else {
            return NULL;
        }
    }

    public static function genPoNo($supplierId = null) {
        $prefix = 'PO'; //$supplierModel->prefix;

        $max_code = intval(Po::findMaxPoNo($prefix));
        $max_code += 1;
        return $prefix . date("Ym") . "-" . str_pad($max_code, 6, "0", STR_PAD_LEFT);
    }

    public static function findMaxPoNo($prefix = NULL) {
        $order = Order::findBySql("SELECT MAX(RIGHT(poNo,6)) as maxCode from `po` WHERE substr(poNo,1,2)='$prefix' order by poNo DESC ")->one();
//        $order = Order::find()->select("MAX(RIGHT(orderNo,7)) as maxCode")
//        ->where("substr(orderNo,1,2)='$prefix' ")
//        ->orderBy('orderNo DESC ')
//        ->max("maxCode");
//        ->one();

        return isset($order) ? $order->maxCode : 0;
    }

    public static function allPurchaseOrder() {
        $all = Po::find()
                ->orderBy("poNo DESC")
                ->all();
        if (isset($all) && !empty($all)) {
            return $all;
        } else {
            return NULL;
        }
    }

    public static function allProductInPo($poId) {
        $poItems = PoItem::find()->where("poId=" . $poId)->all();
        if (isset($poItems) && count($poItems) > 0) {
            return $poItems;
        } else {
            return NULL;
        }
    }

}
