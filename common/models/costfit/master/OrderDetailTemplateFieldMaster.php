<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_detail_template_field".
*
    * @property string $orderDetailTemplateFieldId
    * @property string $orderDetailTemplateId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class OrderDetailTemplateFieldMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_detail_template_field';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderDetailTemplateId', 'title', 'description', 'createDateTime'], 'required'],
            [['orderDetailTemplateId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'description'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderDetailTemplateFieldId' => Yii::t('order_detail_template_field', 'Order Detail Template Field ID'),
    'orderDetailTemplateId' => Yii::t('order_detail_template_field', 'Order Detail Template ID'),
    'title' => Yii::t('order_detail_template_field', 'Title'),
    'description' => Yii::t('order_detail_template_field', 'Description'),
    'status' => Yii::t('order_detail_template_field', 'Status'),
    'createDateTime' => Yii::t('order_detail_template_field', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_detail_template_field', 'Update Date Time'),
];
}
}
