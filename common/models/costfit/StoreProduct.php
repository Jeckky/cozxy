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
class StoreProduct extends \common\models\costfit\master\StoreProductMaster
{

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
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'quantity' => 'จำนวน',
            'price' => 'ราคา',
            'productId' => 'สินค้า',
            'storeId' => 'คลังสินค้า',
            'storeProductGroupId' => 'PO',
            'shippingFromType' => 'วิธีการจัดส่ง',
        ]);
    }

    public function findAllShippingFromTypeArray()
    {
        return [
            self::SHIPPING_FROM_TYPE_COSTFIT => "ส่งจาก costfit",
            self::SHIPPING_FROM_TYPE_SUPPLIER_TO_COSTFIT => "รับจาก Supplier ส่งจาก costfit",
            self::SHIPPING_FROM_TYPE_SUPPLIER => "ส่งจาก Supplier",
        ];
    }

    public function getShippingFromTypeText($type)
    {
        $res = $this->findAllShippingTypeFromArray();
        if (isset($res[$type])) {
            return $res[$type];
        } else {
            return NULL;
        }
    }

    public function findAllStatusArray()
    {
        return [
            self::STATUS_IMPORT => "นำข้อมูลเข้า",
            self::STATUS_QC => "ตรวจและนับแล้ว",
            self::STATUS_ARRANGED_SOME => "เรียงบางส่วนแล้ว",
            self::STATUS_ARRANGED => "เรียงทั้งหมดแล้ว",
        ];
    }

    public function getStatusText($status)
    {
        $res = $this->findAllStatusArray();
        if (isset($res[$status])) {
            return $res[$status];
        } else {
            return NULL;
        }
    }

    public function getStores()
    {

        return $this->hasOne(Store::className(), ['storeId' => 'storeId']);
    }

    public function getProducts()
    {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    public static function arrangeProductToSlot($storeProductId, $slotId, $quantity)
    {
        $model = StoreProductArrange::find()->where('storeProductId =' . $storeProductId . ' AND slotId=' . $slotId . "")->one();
        $storeProduct = StoreProduct::find()->where("storeProductId =" . $storeProductId)->one();
        $haveSomeQuan = FALSE;
        if (!isset($model)) {
            $model = new StoreProductArrange();
            $model->storeProductId = $storeProductId;
            $model->slotId = $slotId;
            $model->productId = $storeProduct->productId;
            $model->quantity = $quantity;
        } else {
            if (($model->quantity + $quantity) > $storeProduct->quantity) {
                $pushQuan = $storeProduct->quantity - $model->quantity;
                $haveSomeQuan = TRUE;
                $someQuan = $quantity - $pushQuan;
                $model->quantity = $pushQuan;
            } else {
                $model->quantity = $quantity;
            }
        }

        if ($haveSomeQuan) {
            //Change Status of store product  = to arrange แล้ว
            //$storeProduct->status = xx
//            $storeProduct->save();
            //Change Status of store product  = to arrange แล้ว
            $someQuanNew = 0;
            while ($someQuan > 0) {
                $otherStoreProduct = StoreProduct::find()->where("productId =" . $storeProduct->productId)->orderBy("createDateTime ASC")->one();
                $modelNew = new StoreProductArrange();
                $modelNew->storeProductId = $storeProductId;
                $modelNew->slotId = $slotId;
                $modelNew->productId = $storeProduct->productId;
                $modelNew->createDateTime = new yii\db\Expression("NOW()");
                if (($someQuan) > $otherStoreProduct->quantity) {
                    $pushQuanNew = $otherStoreProduct->quantity;
                    $someQuan = $someQuan - $otherStoreProduct->quantity;
                    $model->quantity = $pushQuanNew;
                } else {
                    $model->quantity = $someQuan;
                    $someQuan = $someQuan - $otherStoreProduct->quantity;
                }
                $modelNew->save();
            }
        }

        $model->createDateTime = new yii\db\Expression("NOW()");
        $model->save();
    }

}
