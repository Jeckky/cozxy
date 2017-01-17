<?php

namespace common\models\costfit\master;

use Yii;

/**
 * This is the model class for table "product_supplier".
 *
 * @property string $productSupplierId
 * @property string $productId
 * @property string $supplierId
 * @property string $leaseTime
 * @property string $maxQuantity
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDatetime
 */
class ProductSupplierMaster extends \common\models\ModelMaster
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_suppliers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'supplierId'], 'required'],
            [['productId', 'supplierId', 'leaseTime', 'status'], 'integer'],
            [['maxQuantity'], 'number'],
            [['createDateTime', 'updateDatetime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productSupplierId' => Yii::t('product_supplier', 'Product Supplier ID'),
            'productId' => Yii::t('product_supplier', 'Product ID'),
            'supplierId' => Yii::t('product_supplier', 'Supplier ID'),
            'leaseTime' => Yii::t('product_supplier', 'Lease Time'),
            'maxQuantity' => Yii::t('product_supplier', 'Max Quantity'),
            'status' => Yii::t('product_supplier', 'Status'),
            'createDateTime' => Yii::t('product_supplier', 'Create Date Time'),
            'updateDatetime' => Yii::t('product_supplier', 'Update Datetime'),
        ];
    }

}
