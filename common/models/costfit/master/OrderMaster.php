<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order".
*
    * @property string $orderId
    * @property string $userId
    * @property integer $pickingId
    * @property string $token
    * @property string $orderNo
    * @property string $invoiceNo
    * @property string $totalExVat
    * @property string $vat
    * @property string $total
    * @property string $discount
    * @property string $grandTotal
    * @property string $shippingRate
    * @property string $summary
    * @property string $sendDate
    * @property string $billingFirstname
    * @property string $billingLastname
    * @property string $billingCompany
    * @property string $billingTax
    * @property string $billingAddress
    * @property string $billingCountryId
    * @property string $billingProvinceId
    * @property string $billingAmphurId
    * @property string $billingDistrictId
    * @property string $billingZipcode
    * @property string $billingTel
    * @property string $shippingFirstname
    * @property string $shippingLastname
    * @property string $shippingCompany
    * @property string $shippingTax
    * @property string $shippingAddress
    * @property string $shippingCountryId
    * @property string $shippingProvinceId
    * @property string $shippingAmphurId
    * @property string $shippingDistrictId
    * @property string $shippingZipcode
    * @property string $shippingTel
    * @property integer $paymentType
    * @property integer $couponId
    * @property integer $checkStep
    * @property string $note
    * @property string $paymentDateTime
    * @property integer $isSlowest
    * @property integer $color
    * @property integer $pickerId
    * @property string $password
    * @property string $otp
    * @property string $refNo
    * @property integer $status
    * @property integer $error
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $email
*/
class OrderMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'pickingId', 'billingProvinceId', 'billingAmphurId', 'shippingProvinceId', 'shippingAmphurId', 'paymentType', 'couponId', 'checkStep', 'isSlowest', 'color', 'pickerId', 'status', 'error'], 'integer'],
            [['token', 'billingAddress', 'shippingAddress', 'note'], 'string'],
            [['totalExVat', 'vat', 'total', 'discount', 'grandTotal', 'shippingRate', 'summary'], 'number'],
            [['sendDate', 'paymentDateTime', 'createDateTime', 'updateDateTime'], 'safe'],
            [['paymentType', 'createDateTime'], 'required'],
            [['orderNo', 'invoiceNo', 'billingTax', 'billingDistrictId', 'billingTel', 'shippingTax', 'shippingDistrictId', 'shippingTel'], 'string', 'max' => 45],
            [['billingFirstname', 'billingLastname', 'billingCompany', 'shippingFirstname', 'shippingLastname', 'shippingCompany'], 'string', 'max' => 200],
            [['billingCountryId', 'shippingCountryId'], 'string', 'max' => 3],
            [['billingZipcode', 'shippingZipcode'], 'string', 'max' => 10],
            [['password', 'otp', 'refNo'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderId' => Yii::t('order', 'Order ID'),
    'userId' => Yii::t('order', 'User ID'),
    'pickingId' => Yii::t('order', 'Picking ID'),
    'token' => Yii::t('order', 'Token'),
    'orderNo' => Yii::t('order', 'Order No'),
    'invoiceNo' => Yii::t('order', 'Invoice No'),
    'totalExVat' => Yii::t('order', 'Total Ex Vat'),
    'vat' => Yii::t('order', 'Vat'),
    'total' => Yii::t('order', 'Total'),
    'discount' => Yii::t('order', 'Discount'),
    'grandTotal' => Yii::t('order', 'Grand Total'),
    'shippingRate' => Yii::t('order', 'Shipping Rate'),
    'summary' => Yii::t('order', 'Summary'),
    'sendDate' => Yii::t('order', 'Send Date'),
    'billingFirstname' => Yii::t('order', 'Billing Firstname'),
    'billingLastname' => Yii::t('order', 'Billing Lastname'),
    'billingCompany' => Yii::t('order', 'Billing Company'),
    'billingTax' => Yii::t('order', 'Billing Tax'),
    'billingAddress' => Yii::t('order', 'Billing Address'),
    'billingCountryId' => Yii::t('order', 'Billing Country ID'),
    'billingProvinceId' => Yii::t('order', 'Billing Province ID'),
    'billingAmphurId' => Yii::t('order', 'Billing Amphur ID'),
    'billingDistrictId' => Yii::t('order', 'Billing District ID'),
    'billingZipcode' => Yii::t('order', 'Billing Zipcode'),
    'billingTel' => Yii::t('order', 'Billing Tel'),
    'shippingFirstname' => Yii::t('order', 'Shipping Firstname'),
    'shippingLastname' => Yii::t('order', 'Shipping Lastname'),
    'shippingCompany' => Yii::t('order', 'Shipping Company'),
    'shippingTax' => Yii::t('order', 'Shipping Tax'),
    'shippingAddress' => Yii::t('order', 'Shipping Address'),
    'shippingCountryId' => Yii::t('order', 'Shipping Country ID'),
    'shippingProvinceId' => Yii::t('order', 'Shipping Province ID'),
    'shippingAmphurId' => Yii::t('order', 'Shipping Amphur ID'),
    'shippingDistrictId' => Yii::t('order', 'Shipping District ID'),
    'shippingZipcode' => Yii::t('order', 'Shipping Zipcode'),
    'shippingTel' => Yii::t('order', 'Shipping Tel'),
    'paymentType' => Yii::t('order', 'Payment Type'),
    'couponId' => Yii::t('order', 'Coupon ID'),
    'checkStep' => Yii::t('order', 'Check Step'),
    'note' => Yii::t('order', 'Note'),
    'paymentDateTime' => Yii::t('order', 'Payment Date Time'),
    'isSlowest' => Yii::t('order', 'Is Slowest'),
    'color' => Yii::t('order', 'Color'),
    'pickerId' => Yii::t('order', 'Picker ID'),
    'password' => Yii::t('order', 'Password'),
    'otp' => Yii::t('order', 'Otp'),
    'refNo' => Yii::t('order', 'Ref No'),
    'status' => Yii::t('order', 'Status'),
    'error' => Yii::t('order', 'Error'),
    'createDateTime' => Yii::t('order', 'Create Date Time'),
    'updateDateTime' => Yii::t('order', 'Update Date Time'),
    'email' => Yii::t('order', 'Email'),
];
}
}
