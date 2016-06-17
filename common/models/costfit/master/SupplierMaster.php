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
            'supplierId' => 'Supplier ID',
            'name' => 'Name',
            'address' => 'Address',
            'description' => 'Description',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProductGroups()
    {
        return $this->hasMany(StoreProductGroup::className(), ['supplierId' => 'supplierId']);
    }
}
