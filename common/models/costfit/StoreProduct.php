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
    const STATUS_ARRANGING = 5;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'sumQuantity',
        ]);
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

    public function getIsbn() {
        $products = Product::find()->where("productId=" . $this->productId)->one();
        if (isset($products) && !empty($products)) {
            return $products->isbn;
        }
    }

    public function getProducts() {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    public static function arrangeProductToSlot($storeProductId, $slotId, $quantity) {
        $model = StoreProductArrange::find()->where('storeProductId =' . $storeProductId . ' AND slotId=' . $slotId . "")->one();
        $storeProduct = StoreProduct::find()->where("storeProductId =" . $storeProductId)->one();
        $check = '';
        $haveSomeQuan = FALSE;
        if (!isset($model)) {//ไม่เคยมีการเอาของมาจัดเรืยงก่อนหน้านี้
            $model = new StoreProductArrange();
            $model->storeProductId = $storeProductId;
            $model->slotId = $slotId;
            $model->productId = $storeProduct->productId;
            $model->productSuppId = $storeProduct->productSuppId;
            if ($quantity > $storeProduct->importQuantity) {//ของที่เอามาจัดเรียงมากกว่าของที่ตรวจรับ ?
                $pushQuan = $storeProduct->importQuantity; //ของที่จัดเรียง = จำนวนที่นำมาจัดเรียง - จำนวนของที่ตรวจรับ
                $isHave = StoreProductArrange::find()->where("storeProductId =" . $storeProductId)->all();
                $totals = 0;
                if (isset($isHave) && !empty($isHave)) {
                    foreach ($isHave as $isHas):
                        $totals += $isHas->quantity;
                    endforeach;
                    $check = StoreProduct::checkSum($storeProductId, $quantity);
                    //throw new \yii\base\Exception($check);
                    if ($check == 'more') {
                        foreach ($isHave as $isHas):
                            $isHas->status = 4;
                            $isHas->updateDateTime = new \yii\db\Expression('NOW()');
                            $isHas->save();
                        endforeach;
                    }
                    $model->quantity = $storeProduct->importQuantity - $totals;
                    $model->result = $storeProduct->importQuantity - $totals;
                    $someQuan = $quantity - $totals;
                }else {
                    $model->quantity = $pushQuan;
                    $model->result = $pushQuan;
                    $someQuan = $quantity - $pushQuan;
                }
                $haveSomeQuan = TRUE;
                //ส่วนเกิน = ยอดที่น้ำมาจัดเรียง - จำนวนที่จัดเรียง
                $model->status = 4;
                $storeProduct->status = 4;
                //throw new \yii\base\Exception($someQuan . "=" . $quantity . "-" . $pushQuan . "import==>" . $storeProduct->quantity);
            } else if ($quantity < $storeProduct->importQuantity) {//ของที่นำมาจัดเรียง น้อยกว่าของที่ ตรวจรับ
                $check = StoreProduct::checkSum($storeProductId, $quantity);
                //throw new \yii\base\Exception($check);
                if ($check == 'less' || $check == '') {//ไม่ครบถ้าครบ
                    $model->quantity = $quantity;
                    $model->result = $quantity;
                    $model->updateDateTime = new \yii\db\Expression('NOW()');
                    $model->status = 3; //set status เป็นจัดเรียงแล้วบ้างส่วน
                    $storeProduct->status = 3;
                } else {
                    $model->status = 4; //set status เป็นจัดเรียงแล้วทั้งหมด
                    $model->updateDateTime = new \yii\db\Expression('NOW()');
                    $model->quantity = $quantity;
                    $model->result = $quantity;
                    $storeProduct->status = 4;
                }
                // throw new \yii\base\Exception($check);
            } else {//ของที่น้ำมาจัดเรียง เท่ากับของที่ รับเข้า
                $check = StoreProduct::checkSum($storeProductId, $quantity);
                if ($check == 'more') {
                    // $a = StoreProduct::updateMore($storeProductId, $model, $quantity, $slotId);
                } else {
                    $model->status = 4; //set status เป็นจัดเรียงแล้วทั้งหมด
                    $storeProduct->status = 4;
                    $model->updateDateTime = new \yii\db\Expression('NOW()');
                    $model->quantity = $quantity;
                    $model->result = $quantity;
                }
            }
        } else {//มีของอยู่แล้ว เอามาใส่เพิ่ม
            $sumOld = 0;
            $oldProducts = StoreProductArrange::find()->where("storeProductId=" . $storeProductId . " and orderId=0")->all();
            if (isset($oldProducts) && !empty($oldProducts)) {
                foreach ($oldProducts as $old):
                    $sumOld += $old->quantity;
                endforeach;
            }
            if (($sumOld + $quantity) > $storeProduct->importQuantity) {//ของที่เอามาจัดเรียงเพิ่ม + ของที่มีอยู่แล้ว มากกว่า จำนวนที่รับเข้า ?
                $pushQuan = $storeProduct->importQuantity - $model->quantity; //จำนวนที่จัดเรียง($pushQuan) = จำนวนรวมใน PO ทั้งหมด($storeProduct->importQuantity)  -  จำนวนที่มีอยู่แล้วใน slot นั้น ($model->quantity)
                //throw new \yii\base\Exception(1111);
                $haveSomeQuan = TRUE;
                //$someQuan = $quantity - $pushQuan; //ส่วนเกิน จากที่ตรวจรับ
                $someQuan = ($model->quantity + $quantity) - $storeProduct->importQuantity;
                $model->quantity = $pushQuan;
                $model->updateDateTime = new \yii\db\Expression('NOW()');
                $model->status = 4;
            } else if (($sumOld + $quantity) < $storeProduct->importQuantity) {//ของที่นำมาจัดเรียง + ของที่มีอยู่แล้ว น้อยกว่า จำนวนที่รับเข้า
                //throw new \yii\base\Exception($sumOld);
                $pushQuan = $model->quantity + $quantity; //จำนวนที่จัดเรียง = ของที่มีอยู่แล้ว + ของที่นำมาจัดเรียง
                $model->quantity = $pushQuan;
                $model->result = $pushQuan;
                $model->updateDateTime = new \yii\db\Expression('NOW()');
                $model->status = 3; //set status เป็น รับเข้าแล้วบางส่วน
                $storeProduct->status = 3;
            } else { //ถ้าของที่น้ำมาจัดเรียง + ของที่มีอยู่แล้ว เท่ากับ จำนวนที่รับมา
                //throw new \yii\base\Exception(3333);
                $pushQuan = $model->quantity + $quantity; //จำนวนที่บันทึก เท่ากับ  ของที่มีอยู่แล้ว + ของที่เอามาจัดเรียง
                $model->quantity = $pushQuan;
                $model->result = $pushQuan;
                $model->status = 4;
                $storeProduct->status = 4;
                $oldProducts = StoreProductArrange::find()->where("storeProductId=" . $storeProductId . " and orderId=0")->all();
                if (isset($oldProducts) && !empty($oldProducts)) {//เมื่อครบแล้ว อัพเดท product ใน po เดียวกันด้วย
                    foreach ($oldProducts as $old):
                        $old->status = 4;
                        $old->save();
                    endforeach;
                }
            }
        }

        $storeProduct->createDateTime = new yii\db\Expression("NOW()"); //อัพเดท store Product เพื่อ บอกว่า ดึง Id นี้ มาจัดเรียงแล้ว
        $storeProduct->save(false);
        if ($haveSomeQuan) { // ถ้ามีของเหลือจากการจัดเรียง ($someQuan)
            //Change Status of store product  = to arrange แล้ว
            //$storeProduct->status = xx
            //$storeProduct->save();
            //Change Status of store product  = to arrange แล้ว
            //$someQuanNew = 0;
            //throw new \yii\base\Exception($someQuan);
            while ($someQuan > 0) { //ถ้าส่วนที่เกินจาก ที่รับเข้า ยังมากกว่า 0 ทำ
                //$otherStoreProduct = StoreProduct::find()->where("productId =" . $storeProduct->productId . " and status=3")->orderBy("createDateTime ASC")->one(); // หาจาก store_product ที่ productId จากตัวที่ เวลาสร้างน้อยสุด(ตรวจรบครบแล้วแแต่ยังไม่มีการดึงมาจัดเรียง)
                $otherStoreProduct = StoreProduct::find()->where("productSuppId =" . $storeProduct->productSuppId . " and status=3")->orderBy("createDateTime ASC")->one(); // หาจาก store_product ที่ productId จากตัวที่ เวลาสร้างน้อยสุด(ตรวจรบครบแล้วแแต่ยังไม่มีการดึงมาจัดเรียง)
//                $modelNew = new StoreProductArrange();
//                $modelNew->storeProductId = $storeProductId;
//                $modelNew->slotId = $slotId;
//                $modelNew->productId = $storeProduct->productId;
//                $modelNew->createDateTime = new yii\db\Expression("NOW()");
//                $modelNew->status = 99; //set status เป็นของเกิน
                if (isset($otherStoreProduct)) {
                    //  $modelNew->quantity = $someQuan;
                    if (($someQuan) > $otherStoreProduct->importQuantity) {//ถ้า ส่วนที่เกิน มากกว่า ส่วนที่ไปหามาใหม่
                        //throw new \yii\base\Exception('aaa');
                        $pushQuanNew = $otherStoreProduct->importQuantity;
                        $someQuan = $someQuan - $otherStoreProduct->importQuantity;
                        $model->quantity = $pushQuanNew;
                        $otherStoreProduct->status = 4;
                    } else {
                        // throw new \yii\base\Exception('bbb');
                        $model->quantity = $otherStoreProduct->importQuantity;
                        $someQuan = $someQuan - $otherStoreProduct->importQuantity;
                        $otherStoreProduct->status = 4;
                    }
                    $someQuan = $someQuan - $otherStoreProduct->importQuantity; //
                    $otherStoreProduct->createDateTime = new yii\db\Expression("NOW()");
                    $otherStoreProduct->save(false);
                } else {
                    //  $modelNew->quantity = $someQuan;
                    // $modelNew->save(false);
                    break;
                }
                // $modelNew->save(false);
            }
        }
        $model->createDateTime = new yii\db\Expression("NOW()");
        $model->save(false);
    }

    public static function checkSum($storeProductId, $quantity) {
        $total = 0;
        $storeProducts = StoreProduct::find()->where("storeProductId=" . $storeProductId)->one();
        if (isset($storeProducts) && !empty($storeProducts)) {
            $arranges = StoreProductArrange::find()->where("productSuppId=" . $storeProducts->productSuppId . " and storeProductId=" . $storeProductId)->all();
            // $arranges = StoreProductArrange::find()->where("productId=" . $storeProducts->productId . " and storeProductId=" . $storeProductId)->all();
            if (isset($arranges) && !empty($arranges)) {
                foreach ($arranges as $arrange):
                    $total += $arrange->quantity;
                endforeach;
                if ($total + $quantity == $storeProducts->importQuantity) {//ยอดรวมทั้งหมดที่จัดเรียงในStore slot นั้น เท่ากับที่ import มามั๊ย
                    //throw new \yii\base\Exception('aaa');
                    $storeProducts->status = 4;
                    $storeProducts->updateDateTime = new \yii\db\Expression('NOW()');
                    $storeProducts->save(false);
                    $updateArranges = StoreProductArrange::find()->where("storeProductId=" . $storeProductId)->all();
                    foreach ($updateArranges as $updateArrange):
                        $updateArrange->status = 4;
                        $updateArrange->updateDateTime = new \yii\db\Expression('NOW()');
                        $updateArrange->save(false);
                    endforeach;
                    return 'yes'; //เท่ากัน->ครบ
                } else {
                    if ($total + $quantity < $storeProducts->importQuantity) {
                        return 'less'; //น้อยกว่าที่ import
                    } else {
                        return 'more'; //มากกว่าที่ import
                    }
                    return ''; // ไม่เท่ากัน -> เกิน หรือ ไม่ครบ
                }
            } else {
                //throw new \yii\base\Exception($storeProductId);
                return '';
            }
        } else {
            return '';
        }
    }

    public static function updateMore($storeProductId, $model, $quantity, $slotId) {
        $total = 0;
        $storeProducts = StoreProduct::find()->where("storeProductId=" . $storeProductId)->one();
        if (isset($storeProducts) && !empty($storeProducts)) {
            //$arranges = StoreProductArrange::find()->where("productId=" . $storeProducts->productId)->all();
            $arranges = StoreProductArrange::find()->where("productSuppId=" . $storeProducts->productSuppId)->all();
            if (isset($arranges) && !empty($arranges)) {
                foreach ($arranges as $arrange):
                    $total += $arrange->quantity;
                endforeach;
                if (($total + $quantity) > $storeProducts->importQuantity) {
                    $result = ($total + $quantity) - $storeProducts->importQuantity;
//                    $model->status = 4;
//                    $model->quantity = $storeProducts->importQuantity - $total;
//                    $model->result = $storeProducts->importQuantity - $total;
//                    $new = new StoreProductArrange(); //ส่วนที่เหลือ
//                    $new->status = 99;
//                    $new->storeProductId = $storeProductId;
//                    $new->productId = $storeProducts->productId;
//                    $new->slotId = $slotId;
//                    $new->quantity = $result;
//                    $new->updateDateTime = new \yii\db\Expression('NOW()');
//                    $new->save(false);
//                    $storeProducts->status = 4;
//                    $storeProducts->updateDateTime = new \yii\db\Expression('NOW()');
//                    $storeProducts->save(false);
                } else {
                    //throw new \yii\base\Exception($storeProducts->importQuantity . " - " . $total);
                    $result = $quantity;
                    $model->status = 4;
                    $model->quantity = $storeProducts->importQuantity - $total;
                    $model->result = $storeProducts->importQuantity - $total;
                    $storeProducts->status = 4;
                    $storeProducts->updateDateTime = new \yii\db\Expression('NOW()');
                    $storeProducts->save(false);
                    $arranges->status = 4;
                    $arranges->updateDateTime = new \yii\db\Expression('NOW()');
                    $arranges->save(false);
                }
                $model->storeProductId = $storeProductId;
                $model->productId = $storeProducts->productId;
                $model->productSuppId = $storeProducts->productSuppId;
                $model->slotId = $slotId;
                $model->updateDateTime = new \yii\db\Expression('NOW()');
                $model->save(false);
            }
        }
    }

    public function getOrderItem() {
        return $this->hasOne(OrderItem::className(), ['orderItemId' => 'orderItemId']);
    }

    public static function quantity($productId, $storeProductGroupId) {
        $sum = 0;
        //$storeProduct = StoreProduct::find()->where("productId=" . $productId . " and storeProductGroupId in (" . $storeProductGroupId . ")")->all();
        $storeProduct = StoreProduct::find()->where("productSuppId=" . $productId . " and storeProductGroupId in (" . $storeProductGroupId . ")")->all();
        if (isset($storeProduct) && !empty($storeProduct)) {
            foreach ($storeProduct as $product):
                $sum += $product->importQuantity;
            endforeach;
        }
        return $sum;
    }

    public static function createStatus($productId, $storeProductGroupId) {
        $all = 0;
        $some = 0;
        $noSome = 0;
        $no = 0;
        $text = '';
        $storeProduct = StoreProduct::find()->where("productSuppId=" . $productId . " and storeProductGroupId in (" . $storeProductGroupId . ")")->all();
        foreach ($storeProduct as $product):
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
            $storeProduct = StoreProduct::find()->where("productId=" . $productId . " and storeProductGroupId in (" . $storeProductGroupId . ")")->all();
            $hasNoArrange = false;
            foreach ($storeProduct as $product):
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

    public static function allProductInPo($storeProductGroupId) {
        $storeProduct = StoreProduct::find()->where("storeProductGroupId=" . $storeProductGroupId)->all();
        if (isset($storeProduct) && !empty($storeProduct)) {
            return $storeProduct;
        } else {
            return NULL;
        }
    }

}
