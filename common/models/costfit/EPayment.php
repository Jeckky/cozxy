<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\EPaymentMaster;

/**
 * This is the model class for table "e_payment".
 *
 * @property string $ePaymentId
 * @property string $paymentMethodId
 * @property string $bankId
 * @property string $ePaymentTel
 * @property string $ePaymentMerchantId
 * @property string $ePaymentOrgId
 * @property string $ePaymentUrl
 * @property string $ePaymentAccessKey
 * @property string $ePaymentSecretKey
 * @property string $ePaymentProfileId
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class EPayment extends \common\models\costfit\master\EPaymentMaster
{

    const TYPE_TEST = 1;
    const TYPE_PRODUCTION = 2;

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

    public function getTypeArray()
    {
        return [
            self::TYPE_TEST => "Test",
            self::TYPE_PRODUCTION => "Production",
        ];
    }

    public function getTypeText($type)
    {
        $res = $this->getTypeArray();
        if (isset($res[$type])) {
            return $res[$type];
        } else {
            return NULL;
        }
    }

}
