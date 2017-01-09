<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_promotion".
*
    * @property string $productPromotionId
    * @property string $productId
    * @property string $userGroupId
    * @property integer $quantity
    * @property integer $priority
    * @property string $price
    * @property string $dateStart
    * @property string $dateEnd
*/
class ProductPromotionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_promotion';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productId'], 'required'],
            [['productId', 'userGroupId', 'quantity', 'priority'], 'integer'],
            [['price'], 'number'],
            [['dateStart', 'dateEnd'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productPromotionId' => Yii::t('product_promotion', 'Product Promotion ID'),
    'productId' => Yii::t('product_promotion', 'Product ID'),
    'userGroupId' => Yii::t('product_promotion', 'User Group ID'),
    'quantity' => Yii::t('product_promotion', 'Quantity'),
    'priority' => Yii::t('product_promotion', 'Priority'),
    'price' => Yii::t('product_promotion', 'Price'),
    'dateStart' => Yii::t('product_promotion', 'Date Start'),
    'dateEnd' => Yii::t('product_promotion', 'Date End'),
];
}
}
