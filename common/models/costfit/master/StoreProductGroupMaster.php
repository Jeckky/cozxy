<?php

namespace common\models\costfit\master;

use Yii;

/**

 * This is the model class for table "store_product_group".
 *
 * @property string $storeProductGroupId
 * @property string $supplierId
 * @property string $poNo
 * @property string $summary
 * @property string $receiveDate
 * @property string $receiveBy
 * @property string $arranger
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property StoreProduct[] $storeProducts
 * @property Supplier $supplier
 */
class StoreProductGroupMaster extends \common\models\ModelMaster {

    /**
     * @inheritdoc
     */ /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'store_product_group';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['supplierId', 'receiveBy', 'arranger', 'status'], 'integer'],
            [['summary'], 'number'],
            [['receiveDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['createDateTime'], 'required'],
            [['poNo'], 'string', 'max' => 45],
            [['supplierId'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierMaster::className(), 'targetAttribute' => ['supplierId' => 'supplierId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'storeProductGroupId' => Yii::t('store_product_group', 'Store Product Group ID'),
            'supplierId' => Yii::t('store_product_group', 'Supplier ID'),
            'poNo' => Yii::t('store_product_group', 'Po No'),
            'summary' => Yii::t('store_product_group', 'Summary'),
            'receiveDate' => Yii::t('store_product_group', 'Receive Date'),
            'receiveBy' => Yii::t('store_product_group', 'Receive By'),
            'arranger' => Yii::t('store_product_group', 'Arranger'),
            'status' => Yii::t('store_product_group', 'Status'),
            'createDateTime' => Yii::t('store_product_group', 'Create Date Time'),
            'updateDateTime' => Yii::t('store_product_group', 'Update Date Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts() {
        return $this->hasMany(StoreProductMaster::className(), ['storeProductGroupId' => 'storeProductGroupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier() {
        return $this->hasOne(SupplierMaster::className(), ['supplierId' => 'supplierId']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'storeProductGroupId' => Yii::t('store_product_group', 'Store Product Group ID'),
            'supplierId' => Yii::t('store_product_group', 'Supplier ID'),
            'poNo' => Yii::t('store_product_group', 'Po No'),
            'summary' => Yii::t('store_product_group', 'Summary'),
            'receiveDate' => Yii::t('store_product_group', 'Receive Date'),
            'receiveBy' => Yii::t('store_product_group', 'Receive By'),
            'arranger' => Yii::t('store_product_group', 'Arranger'),
            'status' => Yii::t('store_product_group', 'Status'),
            'createDateTime' => Yii::t('store_product_group', 'Create Date Time'),
            'updateDateTime' => Yii::t('store_product_group', 'Update Date Time'),
        ];
    }

}
