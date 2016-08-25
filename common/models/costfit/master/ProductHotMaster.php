<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_hot".
*
    * @property string $productHotId
    * @property string $productId
    * @property string $price
    * @property string $startDate
    * @property string $endDate
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductHotMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_hot';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productId', 'price', 'createDateTime'], 'required'],
            [['productId', 'status'], 'integer'],
            [['price'], 'number'],
            [['startDate', 'endDate', 'createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productHotId' => Yii::t('product_hot', 'Product Hot ID'),
    'productId' => Yii::t('product_hot', 'Product ID'),
    'price' => Yii::t('product_hot', 'Price'),
    'startDate' => Yii::t('product_hot', 'Start Date'),
    'endDate' => Yii::t('product_hot', 'End Date'),
    'status' => Yii::t('product_hot', 'Status'),
    'createDateTime' => Yii::t('product_hot', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_hot', 'Update Date Time'),
];
}
}
