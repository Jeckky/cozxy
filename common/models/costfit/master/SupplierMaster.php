<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "supplier".
*
    * @property string $supplierId
    * @property string $name
    * @property string $address
    * @property integer $taxId
    * @property string $tel
    * @property string $email
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
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
            [['name', 'createDateTime'], 'required'],
            [['address', 'description'], 'string'],
            [['taxId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name', 'email'], 'string', 'max' => 200],
            [['tel'], 'string', 'max' => 45],
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
    'address' => Yii::t('supplier', 'Address'),
    'taxId' => Yii::t('supplier', 'Tax ID'),
    'tel' => Yii::t('supplier', 'Tel'),
    'email' => Yii::t('supplier', 'Email'),
    'description' => Yii::t('supplier', 'Description'),
    'status' => Yii::t('supplier', 'Status'),
    'createDateTime' => Yii::t('supplier', 'Create Date Time'),
    'updateDateTime' => Yii::t('supplier', 'Update Date Time'),
];
}
}
