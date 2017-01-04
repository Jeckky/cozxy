<?php

namespace common\models\costfit\master;

use Yii;

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
class OrderGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'total', 'totalIncVAT', 'discountPercent', 'discountValue', 'createDateTime'], 'required'],
            [['userId', 'supplierId', 'paymentDistrictId', 'paymentAmphurId', 'paymentProvinceId', 'paymentMethod', 'shippingDistrictId', 'shippingAmphurId', 'shippingProvinceId', 'usedPoint', 'isSentToCustomer', 'partnerType', 'parentId', 'mainId', 'mainFurnitureId', 'furnitureGroupId', 'furnitureId', 'isRequestSpacialProject', 'status'], 'integer'],
            [['total', 'vatPercent', 'vatValue', 'totalIncVAT', 'discountPercent', 'discountValue', 'totalPostDiscount', 'distributorDiscountPercent', 'distributorDiscount', 'totalPostDistributorDiscount', 'extraDiscount', 'partnerDiscountPercent', 'partnerDiscountValue', 'summary'], 'number'],
            [['paymentDateTime', 'supplierShippingDateTime', 'createDateTime', 'updateDateTime'], 'safe'],
            [['paymentAddress1', 'paymentAddress2', 'shippingAddress1', 'shippingAddress2', 'remark'], 'string'],
            [['orderNo', 'paymentTaxNo'], 'string', 'max' => 45],
            [['invoiceNo', 'telephone', 'partnerCode'], 'string', 'max' => 20],
            [['firstname', 'lastname', 'email', 'partnerDiscountCode', 'paymentCompany', 'paymentFirstname', 'paymentLastname', 'shippingCompany'], 'string', 'max' => 200],
            [['paymentPostcode', 'shippingPostCode'], 'string', 'max' => 10],
            [['shippingDistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => DistrictMaster::className(), 'targetAttribute' => ['shippingDistrictId' => 'districtId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderGroupId' => Yii::t('order_group', 'Order Group ID'),
    'userId' => Yii::t('order_group', 'User ID'),
    'supplierId' => Yii::t('order_group', 'Supplier ID'),
    'orderNo' => Yii::t('order_group', 'Order No'),
    'invoiceNo' => Yii::t('order_group', 'Invoice No'),
    'firstname' => Yii::t('order_group', 'Firstname'),
    'lastname' => Yii::t('order_group', 'Lastname'),
    'email' => Yii::t('order_group', 'Email'),
    'telephone' => Yii::t('order_group', 'Telephone'),
    'total' => Yii::t('order_group', 'Total'),
    'vatPercent' => Yii::t('order_group', 'Vat Percent'),
    'vatValue' => Yii::t('order_group', 'Vat Value'),
    'totalIncVAT' => Yii::t('order_group', 'Total Inc Vat'),
    'discountPercent' => Yii::t('order_group', 'Discount Percent'),
    'discountValue' => Yii::t('order_group', 'Discount Value'),
    'totalPostDiscount' => Yii::t('order_group', 'Total Post Discount'),
    'distributorDiscountPercent' => Yii::t('order_group', 'Distributor Discount Percent'),
    'distributorDiscount' => Yii::t('order_group', 'Distributor Discount'),
    'totalPostDistributorDiscount' => Yii::t('order_group', 'Total Post Distributor Discount'),
    'extraDiscount' => Yii::t('order_group', 'Extra Discount'),
    'partnerDiscountCode' => Yii::t('order_group', 'Partner Discount Code'),
    'partnerDiscountPercent' => Yii::t('order_group', 'Partner Discount Percent'),
    'partnerDiscountValue' => Yii::t('order_group', 'Partner Discount Value'),
    'summary' => Yii::t('order_group', 'Summary'),
    'paymentDateTime' => Yii::t('order_group', 'Payment Date Time'),
    'paymentCompany' => Yii::t('order_group', 'Payment Company'),
    'paymentFirstname' => Yii::t('order_group', 'Payment Firstname'),
    'paymentLastname' => Yii::t('order_group', 'Payment Lastname'),
    'paymentAddress1' => Yii::t('order_group', 'Payment Address1'),
    'paymentAddress2' => Yii::t('order_group', 'Payment Address2'),
    'paymentDistrictId' => Yii::t('order_group', 'Payment District ID'),
    'paymentAmphurId' => Yii::t('order_group', 'Payment Amphur ID'),
    'paymentProvinceId' => Yii::t('order_group', 'Payment Province ID'),
    'paymentPostcode' => Yii::t('order_group', 'Payment Postcode'),
    'paymentMethod' => Yii::t('order_group', 'Payment Method'),
    'paymentTaxNo' => Yii::t('order_group', 'Payment Tax No'),
    'shippingCompany' => Yii::t('order_group', 'Shipping Company'),
    'shippingAddress1' => Yii::t('order_group', 'Shipping Address1'),
    'shippingAddress2' => Yii::t('order_group', 'Shipping Address2'),
    'shippingDistrictId' => Yii::t('order_group', 'Shipping District ID'),
    'shippingAmphurId' => Yii::t('order_group', 'Shipping Amphur ID'),
    'shippingProvinceId' => Yii::t('order_group', 'Shipping Province ID'),
    'shippingPostCode' => Yii::t('order_group', 'Shipping Post Code'),
    'usedPoint' => Yii::t('order_group', 'Used Point'),
    'isSentToCustomer' => Yii::t('order_group', 'Is Sent To Customer'),
    'remark' => Yii::t('order_group', 'Remark'),
    'supplierShippingDateTime' => Yii::t('order_group', 'Supplier Shipping Date Time'),
    'partnerCode' => Yii::t('order_group', 'Partner Code'),
    'partnerType' => Yii::t('order_group', 'Partner Type'),
    'parentId' => Yii::t('order_group', 'Parent ID'),
    'mainId' => Yii::t('order_group', 'Main ID'),
    'mainFurnitureId' => Yii::t('order_group', 'Main Furniture ID'),
    'furnitureGroupId' => Yii::t('order_group', 'Furniture Group ID'),
    'furnitureId' => Yii::t('order_group', 'Furniture ID'),
    'isRequestSpacialProject' => Yii::t('order_group', 'Is Request Spacial Project'),
    'status' => Yii::t('order_group', 'Status'),
    'createDateTime' => Yii::t('order_group', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_group', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getShippingDistrict()
    {
    return $this->hasOne(DistrictMaster::className(), ['districtId' => 'shippingDistrictId']);
    }
}
