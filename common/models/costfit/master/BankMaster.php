<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "bank".
*
    * @property string $id
    * @property string $bankNameId
    * @property string $branch
    * @property string $accNo
    * @property string $accName
    * @property string $accType
    * @property string $supplierId
    * @property string $compCode
    * @property integer $status
    * @property string $createDateTime
    *
            * @property BankName $bankName
            * @property Supplier $supplier
    */
class BankMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'bank';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['bankNameId', 'branch', 'accNo', 'accName', 'accType', 'supplierId', 'createDateTime'], 'required'],
            [['bankNameId', 'supplierId', 'status'], 'integer'],
            [['accNo'], 'string'],
            [['createDateTime'], 'safe'],
            [['branch'], 'string', 'max' => 25],
            [['accName'], 'string', 'max' => 300],
            [['accType'], 'string', 'max' => 100],
            [['compCode'], 'string', 'max' => 5],
            [['bankNameId'], 'exist', 'skipOnError' => true, 'targetClass' => BankNameMaster::className(), 'targetAttribute' => ['bankNameId' => 'bankNameId']],
            [['supplierId'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierMaster::className(), 'targetAttribute' => ['supplierId' => 'supplierId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('bank', 'ID'),
    'bankNameId' => Yii::t('bank', 'Bank Name ID'),
    'branch' => Yii::t('bank', 'Branch'),
    'accNo' => Yii::t('bank', 'Acc No'),
    'accName' => Yii::t('bank', 'Acc Name'),
    'accType' => Yii::t('bank', 'Acc Type'),
    'supplierId' => Yii::t('bank', 'Supplier ID'),
    'compCode' => Yii::t('bank', 'Comp Code'),
    'status' => Yii::t('bank', 'Status'),
    'createDateTime' => Yii::t('bank', 'Create Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getBankName()
    {
    return $this->hasOne(BankNameMaster::className(), ['bankNameId' => 'bankNameId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSupplier()
    {
    return $this->hasOne(SupplierMaster::className(), ['supplierId' => 'supplierId']);
    }
}
