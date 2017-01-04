<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\SupplierEpaymentMaster;

/**
* This is the model class for table "supplier_epayment".
*
    * @property string $id
    * @property string $supplierId
    * @property integer $enableEPayment
    * @property string $ePaymentTel
    * @property string $ePaymentMerchantId
    * @property string $ePaymentOrgId
    * @property string $ePaymentUrl
    * @property string $ePaymentAccessKey
    * @property string $ePaymentProfileId
    * @property string $ePaymentSecretKey
    * @property integer $type
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Supplier $supplier
    */

class SupplierEpayment extends \common\models\costfit\master\SupplierEpaymentMaster{
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
