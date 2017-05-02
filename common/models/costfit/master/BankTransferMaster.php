<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "bank_transfer".
*
    * @property string $bankTransferId
    * @property string $paymentMethodId
    * @property string $bankId
    * @property string $branch
    * @property string $accNo
    * @property string $accName
    * @property string $accType
    * @property string $compCode
    * @property integer $type
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class BankTransferMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'bank_transfer';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['paymentMethodId', 'bankId', 'branch', 'accNo', 'accName', 'accType', 'createDateTime'], 'required'],
            [['paymentMethodId', 'bankId', 'type', 'status'], 'integer'],
            [['accNo'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['branch'], 'string', 'max' => 25],
            [['accName'], 'string', 'max' => 300],
            [['accType'], 'string', 'max' => 100],
            [['compCode'], 'string', 'max' => 5],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'bankTransferId' => Yii::t('bank_transfer', 'Bank Transfer ID'),
    'paymentMethodId' => Yii::t('bank_transfer', 'Payment Method ID'),
    'bankId' => Yii::t('bank_transfer', 'Bank ID'),
    'branch' => Yii::t('bank_transfer', 'Branch'),
    'accNo' => Yii::t('bank_transfer', 'Acc No'),
    'accName' => Yii::t('bank_transfer', 'Acc Name'),
    'accType' => Yii::t('bank_transfer', 'Acc Type'),
    'compCode' => Yii::t('bank_transfer', 'Comp Code'),
    'type' => Yii::t('bank_transfer', 'Type'),
    'status' => Yii::t('bank_transfer', 'Status'),
    'createDateTime' => Yii::t('bank_transfer', 'Create Date Time'),
    'updateDateTime' => Yii::t('bank_transfer', 'Update Date Time'),
];
}
}
