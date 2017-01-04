<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "province".
*
    * @property string $provinceId
    * @property string $provinceCode
    * @property string $provinceName
    * @property integer $geographyId
    *
            * @property Supplier[] $suppliers
    */
class ProvinceMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'province';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['provinceCode', 'provinceName'], 'required'],
            [['geographyId'], 'integer'],
            [['provinceCode'], 'string', 'max' => 2],
            [['provinceName'], 'string', 'max' => 150],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'provinceId' => Yii::t('province', 'Province ID'),
    'provinceCode' => Yii::t('province', 'Province Code'),
    'provinceName' => Yii::t('province', 'Province Name'),
    'geographyId' => Yii::t('province', 'Geography ID'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSuppliers()
    {
    return $this->hasMany(SupplierMaster::className(), ['provinceId' => 'provinceId']);
    }
}
