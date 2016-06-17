<?php

namespace common\models\costfit\master;

use Yii;

/**
 * This is the model class for table "store_product_group".
 *
 * @property string $storeProductGroupId
 * @property string $supplierId
 * @property string $poNo
 * @property string $title
 * @property string $description
 * @property string $summary
 * @property string $receiveDate
 * @property integer $receiveBy
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property StoreProduct[] $storeProducts
 * @property Supplier $supplier
 */
class StoreProductGroupMaster extends \common\models\ModelMaster
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_product_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplierId', 'receiveBy', 'status'], 'integer'],
            [['title', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['summary'], 'number'],
            [['receiveDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['poNo'], 'string', 'max' => 45],
            [['title'], 'string', 'max' => 200],
            [['supplierId'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplierId' => 'supplierId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'storeProductGroupId' => 'Store Product Group ID',
            'supplierId' => 'Supplier ID',
            'poNo' => 'Po No',
            'title' => 'Title',
            'description' => 'Description',
            'summary' => 'Summary',
            'receiveDate' => 'Receive Date',
            'receiveBy' => 'Receive By',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts()
    {
        return $this->hasMany(StoreProduct::className(), ['storeProductGroupId' => 'storeProductGroupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['supplierId' => 'supplierId']);
    }
}
