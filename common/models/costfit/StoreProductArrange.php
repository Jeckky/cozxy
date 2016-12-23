<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\StoreProductArrangeMaster;

/**
 * This is the model class for table "store_product_arrange".
 *
 * @property string $storeProductArrangeId
 * @property string $storeProductId
 * @property string $slotId
 * @property string $quantity
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class StoreProductArrange extends \common\models\costfit\master\StoreProductArrangeMaster {

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

    public static function findItems($slot, $allOrderId) {
        //throw new \yii\base\Exception($slot);
        $orderId = '';
        foreach ($allOrderId as $id):
            $orderId = $orderId . $id . ",";
        endforeach;
        $orderId = substr($orderId, 0, -1);
        $userId = Yii::$app->user->identity->userId;
        if ($slot != 'a') {
            //$productId = StoreProductArrange::find()->where("slotId=" . $slot . " and status in (99,100) and pickerId='" . $userId . "' and orderId in (" . $orderId . ") order by productId")->all();
            $productId = StoreProductArrange::find()->where("slotId=" . $slot . " and status in (99,100) and pickerId='" . $userId . "' and orderId in (" . $orderId . ") order by productSuppId")->all();
            if (isset($productId)) {
                return $productId;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function sumQuantitiy($productId, $orderId, $slot) {
        $total = 0;
        //$quantity = StoreProductArrange::find()->where("productId=" . $productId . " and orderId=" . $orderId . " and status in(99,100) and slotId=" . $slot)->all();
        $quantity = StoreProductArrange::find()->where("productSuppId=" . $productId . " and orderId=" . $orderId . " and status in(99,100) and slotId=" . $slot)->all();
        if (isset($quantity) && !empty($quantity)) {
            foreach ($quantity as $sum):
                $total = $total + (-($sum->quantity));
            endforeach;
        }
        return $total;
    }

    public static function checkProductId($index, $allOrderId, $slotId) {
        //throw new \yii\base\Exception(print_r($allOrderId, true));
        $orderId = '';
        $i = 0;
        $textChange = [];
        $a = 0;
        $old = '';
        $check = 0;
        foreach ($allOrderId as $id):
            $orderId = $orderId . $id . ",";
        endforeach;
        $orderId = substr($orderId, 0, -1);
        $first = StoreProductArrange::find()->where("slotId=" . $slotId . " and orderId in (" . $orderId . ") order by productId")->one(); //หาตัวแรก
        //$old = $first->productId;
        $old = $first->productSuppId;
        $changes = StoreProductArrange::find()->where("slotId=" . $slotId . " and orderId in (" . $orderId . ") order by productId")->all();
        foreach ($changes as $change) {
            if ($change->productSuppId != $old) {
                $textChange[$a] = $i;
                $a++;
            }
            $old = $change->productSuppId;
            $i++;
        }
        $textChange[$a] = $i;
        foreach ($textChange as $indexChange):
            if (($indexChange - 1) == $index) {
                $check++;
            }
        endforeach;
        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function findProductInSlot($slotId, $allOrderId, $productId) {
        $orderId = '';
        $total = 0;
        foreach ($allOrderId as $id):
            $orderId = $orderId . $id . ",";
        endforeach;
        $orderId = substr($orderId, 0, -1);
        //$products = StoreProductArrange::find()->where("slotId=" . $slotId . " and productId=" . $productId . " and orderId in (" . $orderId . ")")->all();
        $products = StoreProductArrange::find()->where("slotId=" . $slotId . " and productSuppId=" . $productId . " and orderId in (" . $orderId . ")")->all();
        if (isset($products) && !empty($products)) {
            foreach ($products as $product):
                $total = $total + ($product->quantity * (-1));
            endforeach;
        }
        //throw new \yii\base\Exception(print_r($allOrderId, true));
        return $total;
    }

    public static function countProductArrange($productId, $storeProductId) {
        $storeProductArrange = StoreProductArrange::find()->where("productId=" . $productId . " and storeProductId=" . $storeProductId . " and (status=3 or status=4)")->all();
        $total = 0;
        if (isset($storeProductArrange) && !empty($storeProductArrange)) {
            foreach ($storeProductArrange as $arrange):
                $total += $arrange->quantity;
            endforeach;
        }
        return $total;
    }

}
