<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order".
*
    * @property string $orderId
    * @property string $userId
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
    * @property string $billingCompany
    * @property string $billingTax
    * @property string $billingAddress
    * @property string $billingCountryId
    * @property string $billingProvinceId
    * @property string $billingAmphurId
    * @property string $billingDistrictId
    * @property string $billingZipcode
    * @property string $billingTel
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
    * @property string $couponId
    * @property integer $checkStep
    * @property string $note
    * @property string $paymentDateTime
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property User $user
            * @property OrderItem[] $orderItems
            * @property StoreProductOrderItem[] $storeProductOrderItems
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
            [['userId', 'billingProvinceId', 'billingAmphurId', 'shippingProvinceId', 'shippingAmphurId', 'paymentType', 'couponId', 'checkStep', 'status'], 'integer'],
            [['token', 'billingAddress', 'shippingAddress', 'note'], 'string'],
            [['totalExVat', 'vat', 'total', 'discount', 'grandTotal', 'shippingRate', 'summary'], 'number'],
            [['sendDate', 'paymentDateTime', 'createDateTime', 'updateDateTime'], 'safe'],
            [['paymentType', 'createDateTime'], 'required'],
            [['orderNo', 'invoiceNo', 'billingTax', 'billingDistrictId', 'billingTel', 'shippingTax', 'shippingDistrictId', 'shippingTel'], 'string', 'max' => 45],
            [['billingCompany', 'shippingCompany'], 'string', 'max' => 200],
            [['billingCountryId', 'shippingCountryId'], 'string', 'max' => 3],
            [['billingZipcode', 'shippingZipcode'], 'string', 'max' => 10],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => UserMaster::className(), 'targetAttribute' => ['userId' => 'userId']],
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
    'billingCompany' => Yii::t('order', 'Billing Company'),
    'billingTax' => Yii::t('order', 'Billing Tax'),
    'billingAddress' => Yii::t('order', 'Billing Address'),
    'billingCountryId' => Yii::t('order', 'Billing Country ID'),
    'billingProvinceId' => Yii::t('order', 'Billing Province ID'),
    'billingAmphurId' => Yii::t('order', 'Billing Amphur ID'),
    'billingDistrictId' => Yii::t('order', 'Billing District ID'),
    'billingZipcode' => Yii::t('order', 'Billing Zipcode'),
    'billingTel' => Yii::t('order', 'Billing Tel'),
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
    'status' => Yii::t('order', 'Status'),
    'createDateTime' => Yii::t('order', 'Create Date Time'),
    'updateDateTime' => Yii::t('order', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUser()
    {
    return $this->hasOne(UserMaster::className(), ['userId' => 'userId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getOrderItems()
    {
    return $this->hasMany(OrderItemMaster::className(), ['orderId' => 'orderId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getStoreProductOrderItems()
    {
    return $this->hasMany(StoreProductOrderItemMaster::className(), ['orderId' => 'orderId']);
    }
}
