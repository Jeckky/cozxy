<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\TopUpMaster;

/**
 * This is the model class for table "top_up".
 *
 * @property string $topUpId
 * @property integer $userId
 * @property integer $money
 * @property integer $point
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class TopUp extends \common\models\costfit\master\TopUpMaster {

    /**
     * @inheritdoc
     */
    const TOPUP_STATUS_E_PAYMENT_DRAFT = 1; //สร้าง
    const TOPUP_STATUS_COMFIRM_PAYMENT = 2; //ยืนยันการจ่ายเงิน
    const TOPUP_STATUS_E_PAYMENT_SUCCESS = 3; //ผ่าน
    const TOPUP_STATUS_E_PAYMENT_DISCLAIM = 4; //ตัดบัตไม่ผ่าน

    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

}