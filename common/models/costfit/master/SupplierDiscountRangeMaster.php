<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "supplier_discount_range".
*
    * @property string $id
    * @property string $supplierId
    * @property string $min
    * @property string $max
    * @property integer $percentDiscount
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Supplier $supplier
    */
class SupplierDiscountRangeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'supplier_discount_range';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['supplierId', 'min', 'percentDiscount', 'createDateTime'], 'required'],
            [['supplierId', 'percentDiscount', 'status'], 'integer'],
            [['min', 'max'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['supplierId'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierMaster::className(), 'targetAttribute' => ['supplierId' => 'supplierId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('supplier_discount_range', 'ID'),
    'supplierId' => Yii::t('supplier_discount_range', 'Supplier ID'),
    'min' => Yii::t('supplier_discount_range', 'Min'),
    'max' => Yii::t('supplier_discount_range', 'Max'),
    'percentDiscount' => Yii::t('supplier_discount_range', 'Percent Discount'),
    'status' => Yii::t('supplier_discount_range', 'Status'),
    'createDateTime' => Yii::t('supplier_discount_range', 'Create Date Time'),
    'updateDateTime' => Yii::t('supplier_discount_range', 'Update Date Time'),
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
