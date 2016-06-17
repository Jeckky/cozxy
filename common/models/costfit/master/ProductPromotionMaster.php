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
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'productId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productPromotionId' => 'Product Promotion ID',
            'productId' => 'Product ID',
            'statusDate' => 'Status Date',
            'endDate' => 'End Date',
            'discount' => 'Discount',
            'discountType' => 'Discount Type',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }
}
