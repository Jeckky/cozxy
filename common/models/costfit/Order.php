<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderMaster;

/**
* This is the model class for table "order".
*
* @property string $orderId
* @property string $userId
* @property string $token
* @property string $orderNo
* @property string $invoiceNo
* @property string $summary
* @property string $sendDate
* @property string $billingCompany
* @property string $billingTax
* @property string $billingAddress
* @property string $billingCountryId
* @property string $billingProvinceId
* @property string $billingAmphurId
* @property string $billingZipcode
* @property string $billingTel
* @property string $shippingCompany
* @property string $shippingTax
* @property string $shippingAddress
* @property string $shippingCountryId
* @property string $shippingProvinceId
* @property string $shippingAmphurId
* @property string $shippingZipcode
* @property string $shippingTel
* @property integer $paymentType
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*
* @property User $user
* @property StoreProductOrderItem[] $storeProductOrderItems
*/

class Order extends \common\models\costfit\master\OrderMaster{
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
