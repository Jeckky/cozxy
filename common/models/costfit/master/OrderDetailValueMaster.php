<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_detail_value".
*
    * @property string $orderDetailValueId
    * @property string $orderDetailId
    * @property string $orderDetailTemplateFieldId
    * @property string $value
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class OrderDetailValueMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_detail_value';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderDetailId', 'orderDetailTemplateFieldId', 'value', 'createDateTime'], 'required'],
            [['orderDetailId', 'orderDetailTemplateFieldId'], 'integer'],
            [['value'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderDetailValueId' => Yii::t('order_detail_value', 'Order Detail Value ID'),
    'orderDetailId' => Yii::t('order_detail_value', 'Order Detail ID'),
    'orderDetailTemplateFieldId' => Yii::t('order_detail_value', 'Order Detail Template Field ID'),
    'value' => Yii::t('order_detail_value', 'Value'),
    'createDateTime' => Yii::t('order_detail_value', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_detail_value', 'Update Date Time'),
];
}
}
