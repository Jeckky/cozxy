<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_price_match".
*
    * @property integer $productPriceMatchId
    * @property string $productPriceMatchGroupId
    * @property string $productId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductPriceMatchMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_price_match';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productPriceMatchGroupId', 'productId', 'createDateTime'], 'required'],
            [['productPriceMatchGroupId', 'productId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productPriceMatchId' => Yii::t('product_price_match', 'Product Price Match ID'),
    'productPriceMatchGroupId' => Yii::t('product_price_match', 'Product Price Match Group ID'),
    'productId' => Yii::t('product_price_match', 'Product ID'),
    'status' => Yii::t('product_price_match', 'Status'),
    'createDateTime' => Yii::t('product_price_match', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_price_match', 'Update Date Time'),
];
}
}
