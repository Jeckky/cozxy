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
        $userId = '1234';
        if ($slot != 'a') {
            $productId = StoreProductArrange::find()->where("slotId=" . $slot . " and status=99 and pickerId='" . $userId . "' and orderId in (" . $orderId . ")")->all();
            if (isset($productId)) {
                return $productId;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

}
