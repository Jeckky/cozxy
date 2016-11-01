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
        $orderId = '';
        foreach ($allOrderId as $id):
            $orderId = $orderId . $id . ",";
        endforeach;
        $orderId = substr($orderId, 0, -1);
        $userId = Yii::$app->user->identity->userId;
        if ($slot != 'a') {
            $productId = StoreProductArrange::find()->where("slotId=" . $slot . " and status in (99,100) and pickerId='" . $userId . "' and orderId in (" . $orderId . ") order by productId")->all();
            if (isset($productId)) {
                return $productId;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function checkProductId($arrays, $productId) {
        $i = 0;
        foreach ($arrays as $array):
            if ($productId == $array) {
                $i++;
            }
        endforeach;
        // throw new \yii\base\Exception($i . " " . $productId);
        if ($i == 0) {
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
        $products = StoreProductArrange::find()->where("slotId=" . $slotId . " and productId=" . $productId . " and orderId in (" . $orderId . ")")->all();
        if (isset($products) && !empty($products)) {
            foreach ($products as $product):
                $total = $total + ($product->quantity * (-1));
            endforeach;
        }

        return $total;
    }

    public static function countProductArrange($productId, $storeProductId) {
        $storeProductArrange = StoreProductArrange::find()->where("productId=" . $productId . " and storeProductId=" . $storeProductId . " and (status=3 or status=4)")->all();
        $total = 0;
        if (isset($storeProductArrange) && !empty($storeProductArrange)) {
            foreach ($storeProductArrange as $arrange):
                $total+=$arrange->quantity;
            endforeach;
        }
        return $total;
    }

}
