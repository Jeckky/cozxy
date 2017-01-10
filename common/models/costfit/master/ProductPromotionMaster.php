<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_promotion".
*
    * @property string $productPromotionId
    * @property string $productId
    * @property string $statusDate
    * @property string $endDate
    * @property string $discount
    * @property integer $discountType
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Product $product
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
            [['productId', 'discountType', 'status'], 'integer'],
            [['statusDate', 'endDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['discount'], 'number'],
            [['discountType', 'createDateTime'], 'required'],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductMaster::className(), 'targetAttribute' => ['productId' => 'productId']],
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
    'statusDate' => Yii::t('product_promotion', 'Status Date'),
    'endDate' => Yii::t('product_promotion', 'End Date'),
    'discount' => Yii::t('product_promotion', 'Discount'),
    'discountType' => Yii::t('product_promotion', 'Discount Type'),
    'status' => Yii::t('product_promotion', 'Status'),
    'createDateTime' => Yii::t('product_promotion', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_promotion', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProduct()
    {
    return $this->hasOne(ProductMaster::className(), ['productId' => 'productId']);
    }
}
