<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order".
*
    * @property string $orderId
    * @property string $userId
    * @property string $supplierId
    * @property string $provinceId
    * @property string $token
    * @property string $title
    * @property integer $type
    * @property string $total
    * @property string $totalIncVAT
    * @property string $spacialProjectDiscount
    * @property string $remark
    * @property integer $isRequestSpacialProject
    * @property integer $isTheme
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class OrderMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'supplierId', 'provinceId', 'type', 'isRequestSpacialProject', 'isTheme', 'status'], 'integer'],
            [['provinceId', 'createDateTime'], 'required'],
            [['total', 'totalIncVAT', 'spacialProjectDiscount'], 'number'],
            [['remark'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['token', 'title'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderId' => Yii::t('order', 'Order ID'),
    'userId' => Yii::t('order', 'User ID'),
    'supplierId' => Yii::t('order', 'Supplier ID'),
    'provinceId' => Yii::t('order', 'Province ID'),
    'token' => Yii::t('order', 'Token'),
    'title' => Yii::t('order', 'Title'),
    'type' => Yii::t('order', 'Type'),
    'total' => Yii::t('order', 'Total'),
    'totalIncVAT' => Yii::t('order', 'Total Inc Vat'),
    'spacialProjectDiscount' => Yii::t('order', 'Spacial Project Discount'),
    'remark' => Yii::t('order', 'Remark'),
    'isRequestSpacialProject' => Yii::t('order', 'Is Request Spacial Project'),
    'isTheme' => Yii::t('order', 'Is Theme'),
    'status' => Yii::t('order', 'Status'),
    'createDateTime' => Yii::t('order', 'Create Date Time'),
    'updateDateTime' => Yii::t('order', 'Update Date Time'),
];
}
}
