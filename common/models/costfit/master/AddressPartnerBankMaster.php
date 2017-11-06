<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "address_partner_bank".
*
    * @property integer $pbId
    * @property string $userId
    * @property string $bankName
    * @property string $accountHolderName
    * @property string $accountNo
    * @property string $branchName
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class AddressPartnerBankMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'address_partner_bank';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'createDateTime'], 'required'],
            [['userId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['bankName', 'accountHolderName', 'accountNo', 'branchName'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pbId' => Yii::t('address_partner_bank', 'Pb ID'),
    'userId' => Yii::t('address_partner_bank', 'User ID'),
    'bankName' => Yii::t('address_partner_bank', 'Bank Name'),
    'accountHolderName' => Yii::t('address_partner_bank', 'Account Holder Name'),
    'accountNo' => Yii::t('address_partner_bank', 'Account No'),
    'branchName' => Yii::t('address_partner_bank', 'Branch Name'),
    'status' => Yii::t('address_partner_bank', 'Status'),
    'createDateTime' => Yii::t('address_partner_bank', 'Create Date Time'),
    'updateDateTime' => Yii::t('address_partner_bank', 'Update Date Time'),
];
}
}
