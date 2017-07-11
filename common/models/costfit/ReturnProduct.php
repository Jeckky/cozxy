<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ReturnProductMaster;

/**
 * This is the model class for table "return_product".
 *
 * @property string $returnProdctId
 * @property integer $orderId
 * @property integer $orderItemId
 * @property integer $productSuppId
 * @property integer $quantity
 * @property integer $price
 * @property integer $receiver
 * @property integer $status
 * @property integer $createDateTime
 * @property integer $updateDateTime
 */
class ReturnProduct extends \common\models\costfit\master\ReturnProductMaster {

    /**
     * @inheritdoc
     */
    const TICKET_STATUS_CREATE_RETURN = 1;
    const TICKET_STATUS_BOOTH_APPROVED = 2;
    const TICKET_STATUS_BOOT_NOTAPPROVED = 3;
    const TICKET_STATUS_WAIT_COZXY = 4;
    const TICKET_STATUS_COZXY_APPROVED = 5;
    const TICKET_STATUS_COZXY_NOTAPPROVED = 6;

    public function rules() {
        return array_merge(parent::rules(), []);
    }

    public function attributes() {
        return array_merge(parent::attributes(), [
            'invoiceNo',
                /* use end */
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public static function statusText($returnProductId) {
        $returnProduct = ReturnProduct::find()->where("returnProductId=" . $returnProductId)->one();
        $status = '';
        if (isset($returnProduct) && !empty($returnProduct)) {
            if ($returnProduct->status == ReturnProduct::TICKET_STATUS_CREATE_RETURN) {
                $status = 'wait for approve';
            }
            if ($returnProduct->status == ReturnProduct::TICKET_STATUS_BOOTH_APPROVED) {
                $status = 'Booth approved';
            }
            if ($returnProduct->status == ReturnProduct::TICKET_STATUS_BOOT_NOTAPPROVED) {
                $status = 'Booth not approve';
            }
            if ($returnProduct->status == ReturnProduct::TICKET_STATUS_WAIT_COZXY) {
                $status = 'Wait for Cozxy approve';
            }
            if ($returnProduct->status == ReturnProduct::TICKET_STATUS_COZXY_APPROVED) {
                $status = 'Cozxy approved';
            }
            if ($returnProduct->status == ReturnProduct::TICKET_STATUS_COZXY_NOTAPPROVED) {
                $status = 'Cozxy not approve';
            }
        }
        return $status;
    }

}
