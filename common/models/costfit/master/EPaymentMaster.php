<?php

namespace common\models\costfit\master;

use Yii;

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
class EPaymentMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'e_payment';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['paymentMethodId', 'bankId', 'ePaymentTel', 'ePaymentMerchantId', 'ePaymentOrgId', 'ePaymentUrl', 'ePaymentAccessKey', 'ePaymentSecretKey', 'ePaymentProfileId', 'createDateTime'], 'required'],
            [['paymentMethodId', 'bankId', 'type', 'status'], 'integer'],
            [['ePaymentUrl', 'ePaymentAccessKey', 'ePaymentSecretKey'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['ePaymentTel'], 'string', 'max' => 30],
            [['ePaymentMerchantId', 'ePaymentOrgId', 'ePaymentProfileId'], 'string', 'max' => 50],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'ePaymentId' => Yii::t('e_payment', 'E Payment ID'),
    'paymentMethodId' => Yii::t('e_payment', 'Payment Method ID'),
    'bankId' => Yii::t('e_payment', 'Bank ID'),
    'ePaymentTel' => Yii::t('e_payment', 'E Payment Tel'),
    'ePaymentMerchantId' => Yii::t('e_payment', 'E Payment Merchant ID'),
    'ePaymentOrgId' => Yii::t('e_payment', 'E Payment Org ID'),
    'ePaymentUrl' => Yii::t('e_payment', 'E Payment Url'),
    'ePaymentAccessKey' => Yii::t('e_payment', 'E Payment Access Key'),
    'ePaymentSecretKey' => Yii::t('e_payment', 'E Payment Secret Key'),
    'ePaymentProfileId' => Yii::t('e_payment', 'E Payment Profile ID'),
    'type' => Yii::t('e_payment', 'Type'),
    'status' => Yii::t('e_payment', 'Status'),
    'createDateTime' => Yii::t('e_payment', 'Create Date Time'),
    'updateDateTime' => Yii::t('e_payment', 'Update Date Time'),
];
}
}
