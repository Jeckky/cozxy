<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderGroupMaster;

/**
* This is the model class for table "order_group".
*
    * @property string $orderGroupId
    * @property string $userId
    * @property string $supplierId
    * @property string $orderNo
    * @property string $invoiceNo
    * @property string $firstname
    * @property string $lastname
    * @property string $email
    * @property string $telephone
    * @property string $total
    * @property string $vatPercent
    * @property string $vatValue
    * @property string $totalIncVAT
    * @property string $discountPercent
    * @property string $discountValue
    * @property string $totalPostDiscount
    * @property string $distributorDiscountPercent
    * @property string $distributorDiscount
    * @property string $totalPostDistributorDiscount
    * @property string $extraDiscount
    * @property string $partnerDiscountCode
    * @property string $partnerDiscountPercent
    * @property string $partnerDiscountValue
    * @property string $summary
    * @property string $paymentDateTime
    * @property string $paymentCompany
    * @property string $paymentFirstname
    * @property string $paymentLastname
    * @property string $paymentAddress1
    * @property string $paymentAddress2
    * @property string $paymentDistrictId
    * @property string $paymentAmphurId
    * @property string $paymentProvinceId
    * @property string $paymentPostcode
    * @property integer $paymentMethod
    * @property string $paymentTaxNo
    * @property string $shippingCompany
    * @property string $shippingAddress1
    * @property string $shippingAddress2
    * @property string $shippingDistrictId
    * @property string $shippingAmphurId
    * @property string $shippingProvinceId
    * @property string $shippingPostCode
    * @property integer $usedPoint
    * @property integer $isSentToCustomer
    * @property string $remark
    * @property string $supplierShippingDateTime
    * @property string $partnerCode
    * @property integer $partnerType
    * @property string $parentId
    * @property string $mainId
    * @property string $mainFurnitureId
    * @property string $furnitureGroupId
    * @property string $furnitureId
    * @property integer $isRequestSpacialProject
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property District $shippingDistrict
    */

class OrderGroup extends \common\models\costfit\master\OrderGroupMaster{
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
