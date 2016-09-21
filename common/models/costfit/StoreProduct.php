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
    const STATUS_IMPORT = 1;
    const STATUS_QC = 2;
    const STATUS_ARRANGED_SOME = 3;
    const STATUS_ARRANGED = 4;

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

    public function findAllStatusArray() {
        return [
            self::STATUS_IMPORT => "นำข้อมูลเข้า",
            self::STATUS_QC => "ตรวจและนับแล้ว",
            self::STATUS_ARRANGED_SOME => "เรียงบางส่วนแล้ว",
            self::STATUS_ARRANGED => "เรียงทั้งหมดแล้ว",
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
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    public static function arrangeProductToSlot($storeProductId, $slotId, $quantity) {
        $model = StoreProductArrange::find()->where('storeProductId =' . $storeProductId . ' AND slotId=' . $slotId . "")->one();
        $storeProduct = StoreProduct::find()->where("storeProductId =" . $storeProductId)->one();
        $haveSomeQuan = FALSE;
        if (!isset($model)) {//ไม่เคยมีการเอาของมาจัดเรืยงก่อนหน้านี้
            $model = new StoreProductArrange();
            $model->storeProductId = $storeProductId;
            $model->slotId = $slotId;
            $model->productId = $storeProduct->productId;
            if ($quantity > $storeProduct->importQuantity) {//ของที่เอามาจัดเรียงมากกว่าของที่ตรวจรับ ?
                $pushQuan = $storeProduct->importQuantity; //ของที่จัดเรียง = จำนวนที่นำมาจัดเรียง - จำนวนของที่ตรวจรับ
                $haveSomeQuan = TRUE;
                $someQuan = $quantity - $pushQuan; //ส่วนเกิน = ยอดที่น้ำมาจัดเรียง - จำนวนที่จัดเรียง
                $model->quantity = $pushQuan;
                $model->status = 4;
                $storeProduct->status = 4;
                //throw new \yii\base\Exception($someQuan . "=" . $quantity . "-" . $pushQuan . "import==>" . $storeProduct->quantity);
            } else if ($quantity < $storeProduct->importQuantity) {//ของที่น้ำมาจัดเรียง น้อยกว่าของที่ ตรวจรับ
                $model->quantity = $quantity;
                $model->status = 3; //set status เป็นจัดเรียงแล้วบ้างส่วน
            } else {//ของที่น้ำมาจัดเรียง เท่ากับของที่ รับเข้า
                $model->status = 4; //set status เป็นจัดเรียงแล้วทั้งหมด
                $storeProduct->status = 4;
                $model->quantity = $quantity;
            }
        } else {//มีของอยู่แล้ว เอามาใส่เพิ่ม
            if (($model->quantity + $quantity) > $storeProduct->importQuantity) {//ของที่เอามาจัดเรียงเพิ่ม + ของที่มีอยู่แล้ว มากกว่า จำนวนที่รับเข้า ?
                $pushQuan = $storeProduct->importQuantity - $model->quantity; //จำนวนที่จัดเรียง($pushQuan) = จำนวนรวมใน PO ทั้งหมด($storeProduct->importQuantity)  -  จำนวนที่มีอยู่แล้วใน slot นั้น ($model->quantity)
                $haveSomeQuan = TRUE;
                //$someQuan = $quantity - $pushQuan; //ส่วนเกิน จากที่ตรวจรับ
                $someQuan = ($model->quantity + $quantity) - $storeProduct->importQuantity;
                $model->quantity = $pushQuan;
                $model->status = 3;
            } else if (($model->quantity + $quantity) < $storeProduct->importQuantity) {//ของที่นำมาจัดเรียง + ของที่มีอยู่แล้ว น้อยกว่า จำนวนที่รับเข้า
                $pushQuan = $model->quantity + $quantity; //จำนวนที่จัดเรียง = ของที่มีอยู่แล้ว + ของที่นำมาจัดเรียง
                $model->quantity = $pushQuan;
                $model->status = 3; //set status เป็น รับเข้าแล้วบางส่วน
            } else { //ถ้าของที่น้ำมาจัดเรียง + ของที่มีอยู่แล้ว เท่ากับ จำนวนที่รับมา
                $pushQuan = $model->quantity + $quantity; //จำนวนที่บันทึก เท่ากับ  ของที่มีอยู่แล้ว + ของที่เอามาจัดเรียง
                $model->quantity = $pushQuan;
                $model->status = 4;
                $storeProduct->status = 4;
            }
        }

        $storeProduct->createDateTime = new yii\db\Expression("NOW()"); //อัพเดท store Product เพื่อ บอกว่า ดึง Id นี้ มาจัดเรียงแล้ว
        $storeProduct->save();
        if ($haveSomeQuan) { // ถ้ามีของเหลือจากการจัดเรียง ($someQuan)
            //Change Status of store product  = to arrange แล้ว
            //$storeProduct->status = xx
            //$storeProduct->save();
            //Change Status of store product  = to arrange แล้ว
            //$someQuanNew = 0;
            while ($someQuan > 0) { //ถ้าส่วนที่เกินจาก ที่รับเข้า ยังมากกว่า 0 ทำ
                //throw new \yii\base\Exception($someQuan);
                $otherStoreProduct = StoreProduct::find()->where("productId =" . $storeProduct->productId . " and status=3")->orderBy("createDateTime ASC")->one(); // หาจาก store_product ที่ productId จากตัวที่ เวลาสร้างน้อยสุด(ตรวจรบครบแล้วแแต่ยังไม่มีการดึงมาจัดเรียง)
                $modelNew = new StoreProductArrange();
                $modelNew->storeProductId = $storeProductId;
                $modelNew->slotId = $slotId;
                $modelNew->productId = $storeProduct->productId;
                $modelNew->createDateTime = new yii\db\Expression("NOW()");
                $modelNew->status = 99; //set status เป็นของเกิน
                if (isset($otherStoreProduct)) {
                    $someQuan = $someQuan - $otherStoreProduct->importQuantity; //
                    $modelNew->quantity = $someQuan;
                    if (($someQuan) > $otherStoreProduct->importQuantity) {//ถ้า ส่วนที่เกิน มากกว่า ส่วนที่ไปหามาใหม่
                        $pushQuanNew = $otherStoreProduct->importQuantity;
                        $someQuan = $someQuan - $otherStoreProduct->importQuantity;
                        $model->quantity = $pushQuanNew;
                        $otherStoreProduct->status = 4;
                    } else {
                        $model->quantity = $someQuan;
                        $someQuan = $someQuan - $otherStoreProduct->importQuantity;
                        $otherStoreProduct->status = 4;
                    }
                    $otherStoreProduct->createDateTime = new yii\db\Expression("NOW()");
                    $otherStoreProduct->save();
                } else {
                    $modelNew->quantity = $someQuan;
                    $modelNew->save(false);
                    break;
                }
                $modelNew->save(false);
            }
        }
        $model->createDateTime = new yii\db\Expression("NOW()");
        $model->save();
    }

}
