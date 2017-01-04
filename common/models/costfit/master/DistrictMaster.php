<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "district".
*
    * @property string $districtId
    * @property string $districtCode
    * @property string $districtName
    * @property integer $amphurId
    * @property integer $provinceId
    * @property integer $geographyId
    *
            * @property OrderGroup[] $orderGroups
            * @property Supplier[] $suppliers
    */
class DistrictMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'district';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['districtCode', 'districtName'], 'required'],
            [['amphurId', 'provinceId', 'geographyId'], 'integer'],
            [['districtCode'], 'string', 'max' => 6],
            [['districtName'], 'string', 'max' => 150],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'districtId' => Yii::t('district', 'District ID'),
    'districtCode' => Yii::t('district', 'District Code'),
    'districtName' => Yii::t('district', 'District Name'),
    'amphurId' => Yii::t('district', 'Amphur ID'),
    'provinceId' => Yii::t('district', 'Province ID'),
    'geographyId' => Yii::t('district', 'Geography ID'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getOrderGroups()
    {
    return $this->hasMany(OrderGroupMaster::className(), ['shippingDistrictId' => 'districtId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSuppliers()
    {
    return $this->hasMany(SupplierMaster::className(), ['districtId' => 'districtId']);
    }
}
