<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "supplier".
*
    * @property string $supplierId
    * @property string $name
    * @property string $address
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property StoreProductGroup[] $storeProductGroups
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
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name'], 'string', 'max' => 200],
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
    'description' => Yii::t('supplier', 'Description'),
    'status' => Yii::t('supplier', 'Status'),
    'createDateTime' => Yii::t('supplier', 'Create Date Time'),
    'updateDateTime' => Yii::t('supplier', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getStoreProductGroups()
    {
    return $this->hasMany(StoreProductGroupMaster::className(), ['supplierId' => 'supplierId']);
    }
}
