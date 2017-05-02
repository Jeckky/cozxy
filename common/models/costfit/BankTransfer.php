<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\BankTransferMaster;

/**
 * This is the model class for table "bank_transfer".
 *
 * @property string $bankTransferId
 * @property string $paymentMethodId
 * @property string $bankId
 * @property string $branch
 * @property string $accNo
 * @property string $accName
 * @property string $accType
 * @property string $compCode
 * @property string $supplierId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class BankTransfer extends \common\models\costfit\master\BankTransferMaster
{

    /**
     * @inheritdoc
     */
    const TYPE_BILL_PAYMENT = 1;
    const TYPE_NORMAL_TRANSFER = 2;
    const ACCOUNT_TYPE_SAVING = 1;
    const ACCOUNT_TYPE_CURRENT = 2;

    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['paymentMethodId' => 'paymentMethodId']);
    }

    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['bankId' => 'bankId']);
    }

    public static function findTypeArray()
    {
        return [
            self::TYPE_BILL_PAYMENT => "Bill Payment",
            self::TYPE_NORMAL_TRANSFER => "Normal Transfer"
        ];
    }

    public static function getTypeText($type)
    {
        $res = self::findTypeArray();
        if (isset($res[$type])) {
            return $res[$type];
        } else {
            return NULL;
        }
    }

    public static function findAccountTypeArray()
    {
        return [
            self::ACCOUNT_TYPE_SAVING => "ออมทรัพย์",
            self::ACCOUNT_TYPE_CURRENT => "กระแสรายวัน"
        ];
    }

    public static function getAccountTypeText($type)
    {
        $res = self::findAccountTypeArray();
        if (isset($res[$type])) {
            return $res[$type];
        } else {
            return NULL;
        }
    }

}
