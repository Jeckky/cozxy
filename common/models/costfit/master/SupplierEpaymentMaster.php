<?php

namespace common\models\costfit\master;

use Yii;

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
class SupplierEpaymentMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'supplier_epayment';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['supplierId', 'ePaymentTel', 'ePaymentMerchantId', 'ePaymentOrgId', 'ePaymentUrl', 'ePaymentAccessKey', 'ePaymentProfileId', 'ePaymentSecretKey', 'createDateTime'], 'required'],
            [['supplierId', 'enableEPayment', 'type', 'status'], 'integer'],
            [['ePaymentUrl', 'ePaymentAccessKey', 'ePaymentSecretKey'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['ePaymentTel'], 'string', 'max' => 30],
            [['ePaymentMerchantId', 'ePaymentOrgId', 'ePaymentProfileId'], 'string', 'max' => 50],
            [['supplierId'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierMaster::className(), 'targetAttribute' => ['supplierId' => 'supplierId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('supplier_epayment', 'ID'),
    'supplierId' => Yii::t('supplier_epayment', 'Supplier ID'),
    'enableEPayment' => Yii::t('supplier_epayment', 'Enable Epayment'),
    'ePaymentTel' => Yii::t('supplier_epayment', 'E Payment Tel'),
    'ePaymentMerchantId' => Yii::t('supplier_epayment', 'E Payment Merchant ID'),
    'ePaymentOrgId' => Yii::t('supplier_epayment', 'E Payment Org ID'),
    'ePaymentUrl' => Yii::t('supplier_epayment', 'E Payment Url'),
    'ePaymentAccessKey' => Yii::t('supplier_epayment', 'E Payment Access Key'),
    'ePaymentProfileId' => Yii::t('supplier_epayment', 'E Payment Profile ID'),
    'ePaymentSecretKey' => Yii::t('supplier_epayment', 'E Payment Secret Key'),
    'type' => Yii::t('supplier_epayment', 'Type'),
    'status' => Yii::t('supplier_epayment', 'Status'),
    'createDateTime' => Yii::t('supplier_epayment', 'Create Date Time'),
    'updateDateTime' => Yii::t('supplier_epayment', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSupplier()
    {
    return $this->hasOne(SupplierMaster::className(), ['supplierId' => 'supplierId']);
    }
}
