<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_price_match".
*
    * @property integer $productPriceMatchId
    * @property integer $productId
    * @property integer $discountPercent
    * @property integer $discountValue
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $productMatchId
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
            [['productPriceMatchId', 'productId', 'createDateTime', 'productMatchId'], 'required'],
            [['productPriceMatchId', 'productId', 'discountPercent', 'discountValue', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['productMatchId'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productPriceMatchId' => Yii::t('product_price_match', 'Product Price Match ID'),
    'productId' => Yii::t('product_price_match', 'Product ID'),
    'discountPercent' => Yii::t('product_price_match', 'Discount Percent'),
    'discountValue' => Yii::t('product_price_match', 'Discount Value'),
    'status' => Yii::t('product_price_match', 'Status'),
    'createDateTime' => Yii::t('product_price_match', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_price_match', 'Update Date Time'),
    'productMatchId' => Yii::t('product_price_match', 'Product Match ID'),
];
}
}
