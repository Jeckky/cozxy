<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_group_category".
*
    * @property string $productGroupCategoryId
    * @property string $categoryId
    * @property string $productGroupId
    *
            * @property Category $category
            * @property Product $productGroup
    */
class ProductGroupCategoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_group_category';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['categoryId', 'productGroupId'], 'required'],
            [['categoryId', 'productGroupId'], 'integer'],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryMaster::className(), 'targetAttribute' => ['categoryId' => 'categoryId']],
            [['productGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductMaster::className(), 'targetAttribute' => ['productGroupId' => 'productId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productGroupCategoryId' => Yii::t('product_group_category', 'Product Group Category ID'),
    'categoryId' => Yii::t('product_group_category', 'Category ID'),
    'productGroupId' => Yii::t('product_group_category', 'Product Group ID'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCategory()
    {
    return $this->hasOne(CategoryMaster::className(), ['categoryId' => 'categoryId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductGroup()
    {
    return $this->hasOne(ProductMaster::className(), ['productId' => 'productGroupId']);
    }
}
