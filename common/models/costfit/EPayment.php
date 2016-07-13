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

class EPayment extends \common\models\costfit\master\EPaymentMaster{
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
}
