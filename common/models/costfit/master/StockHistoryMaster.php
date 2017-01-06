<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "stock_history".
*
    * @property string $stockHistoryId
    * @property integer $orderItemId
    * @property integer $productSuppId
    * @property integer $quantity
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class StockHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'stock_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderItemId', 'productSuppId', 'quantity', 'createDateTime'], 'required'],
            [['orderItemId', 'productSuppId', 'quantity', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'stockHistoryId' => Yii::t('stock_history', 'Stock History ID'),
    'orderItemId' => Yii::t('stock_history', 'Order Item ID'),
    'productSuppId' => Yii::t('stock_history', 'Product Supp ID'),
    'quantity' => Yii::t('stock_history', 'Quantity'),
    'status' => Yii::t('stock_history', 'Status'),
    'createDateTime' => Yii::t('stock_history', 'Create Date Time'),
    'updateDateTime' => Yii::t('stock_history', 'Update Date Time'),
];
}
}
