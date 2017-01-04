<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_detail".
*
    * @property string $orderDetailId
    * @property string $orderDetailTemplateId
    * @property string $orderId
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class OrderDetailMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_detail';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderDetailTemplateId', 'orderId', 'createDateTime'], 'required'],
            [['orderDetailTemplateId', 'orderId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderDetailId' => Yii::t('order_detail', 'Order Detail ID'),
    'orderDetailTemplateId' => Yii::t('order_detail', 'Order Detail Template ID'),
    'orderId' => Yii::t('order_detail', 'Order ID'),
    'createDateTime' => Yii::t('order_detail', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_detail', 'Update Date Time'),
];
}
}
