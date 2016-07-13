<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "payment_method".
*
    * @property string $paymentMethodId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $type
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PaymentMethodMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'payment_method';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['description'], 'string'],
            [['type', 'createDateTime'], 'required'],
            [['type', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'paymentMethodId' => Yii::t('payment_method', 'Payment Method ID'),
    'title' => Yii::t('payment_method', 'Title'),
    'description' => Yii::t('payment_method', 'Description'),
    'image' => Yii::t('payment_method', 'Image'),
    'type' => Yii::t('payment_method', 'Type'),
    'status' => Yii::t('payment_method', 'Status'),
    'createDateTime' => Yii::t('payment_method', 'Create Date Time'),
    'updateDateTime' => Yii::t('payment_method', 'Update Date Time'),
];
}
}
