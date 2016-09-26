<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "store_picking".
*
    * @property integer $storePickingId
    * @property integer $pickerId
    * @property string $orderId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class StorePickingMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'store_picking';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['pickerId', 'orderId'], 'required'],
            [['pickerId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['orderId'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'storePickingId' => Yii::t('store_picking', 'Store Picking ID'),
    'pickerId' => Yii::t('store_picking', 'Picker ID'),
    'orderId' => Yii::t('store_picking', 'Order ID'),
    'status' => Yii::t('store_picking', 'Status'),
    'createDateTime' => Yii::t('store_picking', 'Create Date Time'),
    'updateDateTime' => Yii::t('store_picking', 'Update Date Time'),
];
}
}
