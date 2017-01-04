<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_group_to_order".
*
    * @property string $id
    * @property string $orderGroupId
    * @property string $orderId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class OrderGroupToOrderMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_group_to_order';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderGroupId', 'orderId', 'createDateTime'], 'required'],
            [['orderGroupId', 'orderId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('order_group_to_order', 'ID'),
    'orderGroupId' => Yii::t('order_group_to_order', 'Order Group ID'),
    'orderId' => Yii::t('order_group_to_order', 'Order ID'),
    'status' => Yii::t('order_group_to_order', 'Status'),
    'createDateTime' => Yii::t('order_group_to_order', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_group_to_order', 'Update Date Time'),
];
}
}
