<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "supplier".
*
    * @property string $supplierId
    * @property string $name
    * @property string $prefix
    * @property string $description
    * @property string $companyName
    * @property string $companyNameEng
    * @property string $address1
    * @property string $address2
    * @property string $districtId
    * @property string $amphurId
    * @property string $provinceId
    * @property string $postcode
    * @property string $taxNumber
    * @property string $email
    * @property string $tel
    * @property string $fax
    * @property string $logo
    * @property string $logoDoc
    * @property string $url
    * @property string $minimumOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Bank[] $banks
            * @property OrderDetailTemplate[] $orderDetailTemplates
            * @property District $district
            * @property Province $province
            * @property SupplierDiscountRange[] $supplierDiscountRanges
            * @property SupplierEpayment[] $supplierEpayments
    */
class SupplierMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'supplier';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['name', 'districtId', 'amphurId', 'provinceId', 'postcode', 'logo', 'createDateTime'], 'required'],
            [['description', 'address1', 'address2'], 'string'],
            [['districtId', 'amphurId', 'provinceId', 'status'], 'integer'],
            [['minimumOrder'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name', 'companyName', 'companyNameEng', 'email'], 'string', 'max' => 200],
            [['prefix'], 'string', 'max' => 5],
            [['postcode'], 'string', 'max' => 10],
            [['taxNumber'], 'string', 'max' => 50],
            [['tel', 'fax'], 'string', 'max' => 25],
            [['logo', 'logoDoc', 'url'], 'string', 'max' => 255],
            [['districtId'], 'exist', 'skipOnError' => true, 'targetClass' => DistrictMaster::className(), 'targetAttribute' => ['districtId' => 'districtId']],
            [['provinceId'], 'exist', 'skipOnError' => true, 'targetClass' => ProvinceMaster::className(), 'targetAttribute' => ['provinceId' => 'provinceId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'supplierId' => Yii::t('supplier', 'Supplier ID'),
    'name' => Yii::t('supplier', 'Name'),
    'prefix' => Yii::t('supplier', 'Prefix'),
    'description' => Yii::t('supplier', 'Description'),
    'companyName' => Yii::t('supplier', 'Company Name'),
    'companyNameEng' => Yii::t('supplier', 'Company Name Eng'),
    'address1' => Yii::t('supplier', 'Address1'),
    'address2' => Yii::t('supplier', 'Address2'),
    'districtId' => Yii::t('supplier', 'District ID'),
    'amphurId' => Yii::t('supplier', 'Amphur ID'),
    'provinceId' => Yii::t('supplier', 'Province ID'),
    'postcode' => Yii::t('supplier', 'Postcode'),
    'taxNumber' => Yii::t('supplier', 'Tax Number'),
    'email' => Yii::t('supplier', 'Email'),
    'tel' => Yii::t('supplier', 'Tel'),
    'fax' => Yii::t('supplier', 'Fax'),
    'logo' => Yii::t('supplier', 'Logo'),
    'logoDoc' => Yii::t('supplier', 'Logo Doc'),
    'url' => Yii::t('supplier', 'Url'),
    'minimumOrder' => Yii::t('supplier', 'Minimum Order'),
    'status' => Yii::t('supplier', 'Status'),
    'createDateTime' => Yii::t('supplier', 'Create Date Time'),
    'updateDateTime' => Yii::t('supplier', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getBanks()
    {
    return $this->hasMany(BankMaster::className(), ['supplierId' => 'supplierId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getOrderDetailTemplates()
    {
    return $this->hasMany(OrderDetailTemplateMaster::className(), ['supplierId' => 'supplierId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getDistrict()
    {
    return $this->hasOne(DistrictMaster::className(), ['districtId' => 'districtId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProvince()
    {
    return $this->hasOne(ProvinceMaster::className(), ['provinceId' => 'provinceId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSupplierDiscountRanges()
    {
    return $this->hasMany(SupplierDiscountRangeMaster::className(), ['supplierId' => 'supplierId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSupplierEpayments()
    {
    return $this->hasMany(SupplierEpaymentMaster::className(), ['supplierId' => 'supplierId']);
    }
}
