<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PaymentMethodMaster;

/**
 * This is the model class for table "payment_method".
 *
 * @property string $paymentMethodId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class PaymentMethod extends \common\models\costfit\master\PaymentMethodMaster
{

    /**
     * @inheritdoc
     */
    const TYPE_BANK_TRANSFER = 1;
    const TYPE_CREDIT_CARD = 2;

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

    public function getTypeArray()
    {
        return [
            self::TYPE_BANK_TRANSFER => 'โอนเงินผ่านธนาคาร',
            self::TYPE_CREDIT_CARD => 'บัตรเครดิต',
        ];
    }

    public function getTypeText($type)
    {
        $res = $this->getTypeArray();
        if ($res[$type]) {
            return $res[$type];
        } else {
            return NULL;
        }
    }

}
