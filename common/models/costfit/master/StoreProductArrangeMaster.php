<?php

namespace common\models\costfit\master;

use Yii;

/**
 * This is the model class for table "store_product_arrange".
 *
 * @property string $storeProductArrangeId
 * @property string $storeProductId
  <<<<<<< HEAD
 * @property string $productId
  =======
  >>>>>>> origin/master
 * @property string $slotId
 * @property string $quantity
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class StoreProductArrangeMaster extends \common\models\ModelMaster
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_product_arrange';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['storeProductId', 'productId', 'slotId', 'quantity', 'createDateTime'], 'required'],
            [['storeProductId', 'productId', 'slotId', 'status'], 'integer'],
            [['quantity'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'storeProductArrangeId' => Yii::t('store_product_arrange', 'Store Product Arrange ID'),
            'storeProductId' => Yii::t('store_product_arrange', 'Store Product ID'),
            'slotId' => Yii::t('store_product_arrange', 'Slot ID'),
            'quantity' => Yii::t('store_product_arrange', 'Quantity'),
            'status' => Yii::t('store_product_arrange', 'Status'),
            'createDateTime' => Yii::t('store_product_arrange', 'Create Date Time'),
            'updateDateTime' => Yii::t('store_product_arrange', 'Update Date Time'),
        ];
    }

}
