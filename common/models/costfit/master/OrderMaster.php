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
            [['userId', 'billingCountryId', 'billingProvinceId', 'billingAmphurId', 'shippingCountryId', 'shippingProvinceId', 'shippingAmphurId', 'paymentType', 'status'], 'integer'],
            [['token', 'billingAddress', 'shippingAddress'], 'string'],
            [['summary'], 'number'],
            [['sendDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['paymentType', 'createDateTime'], 'required'],
            [['orderNo', 'invoiceNo', 'billingTax', 'billingTel', 'shippingTax', 'shippingTel'], 'string', 'max' => 45],
            [['billingCompany', 'shippingCompany'], 'string', 'max' => 200],
            [['billingZipcode', 'shippingZipcode'], 'string', 'max' => 10],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderId' => 'Order ID',
            'userId' => 'User ID',
            'token' => 'Token',
            'orderNo' => 'Order No',
            'invoiceNo' => 'Invoice No',
            'summary' => 'Summary',
            'sendDate' => 'Send Date',
            'billingCompany' => 'Billing Company',
            'billingTax' => 'Billing Tax',
            'billingAddress' => 'Billing Address',
            'billingCountryId' => 'Billing Country ID',
            'billingProvinceId' => 'Billing Province ID',
            'billingAmphurId' => 'Billing Amphur ID',
            'billingZipcode' => 'Billing Zipcode',
            'billingTel' => 'Billing Tel',
            'shippingCompany' => 'Shipping Company',
            'shippingTax' => 'Shipping Tax',
            'shippingAddress' => 'Shipping Address',
            'shippingCountryId' => 'Shipping Country ID',
            'shippingProvinceId' => 'Shipping Province ID',
            'shippingAmphurId' => 'Shipping Amphur ID',
            'shippingZipcode' => 'Shipping Zipcode',
            'shippingTel' => 'Shipping Tel',
            'paymentType' => 'Payment Type',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductOrderItems()
    {
        return $this->hasMany(StoreProductOrderItem::className(), ['orderId' => 'orderId']);
    }
}
