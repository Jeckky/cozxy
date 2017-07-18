<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "shipping_type".
*
    * @property integer $shippingTypeId
    * @property string $title
    * @property integer $date
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ShippingTypeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'shipping_type';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title', 'date'], 'required'],
            [['date', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'shippingTypeId' => Yii::t('shipping_type', 'Shipping Type ID'),
    'title' => Yii::t('shipping_type', 'Title'),
    'date' => Yii::t('shipping_type', 'Date'),
    'status' => Yii::t('shipping_type', 'Status'),
    'createDateTime' => Yii::t('shipping_type', 'Create Date Time'),
    'updateDateTime' => Yii::t('shipping_type', 'Update Date Time'),
];
}
}
