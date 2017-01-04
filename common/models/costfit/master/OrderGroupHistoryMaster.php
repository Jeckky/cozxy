<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_group_history".
*
    * @property string $orderGroupHistoryId
    * @property string $orderGroupId
    * @property string $decision
    * @property string $description
    * @property string $reasonCode
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class OrderGroupHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_group_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderGroupHistoryId', 'orderGroupId', 'decision', 'description', 'reasonCode', 'createDateTime'], 'required'],
            [['orderGroupHistoryId', 'orderGroupId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['decision', 'reasonCode'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderGroupHistoryId' => Yii::t('order_group_history', 'Order Group History ID'),
    'orderGroupId' => Yii::t('order_group_history', 'Order Group ID'),
    'decision' => Yii::t('order_group_history', 'Decision'),
    'description' => Yii::t('order_group_history', 'Description'),
    'reasonCode' => Yii::t('order_group_history', 'Reason Code'),
    'createDateTime' => Yii::t('order_group_history', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_group_history', 'Update Date Time'),
];
}
}
