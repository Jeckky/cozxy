<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product".
*
    * @property string $productId
    * @property string $userId
    * @property string $productGroupId
    * @property string $brandId
    * @property string $categoryId
    * @property string $code
    * @property string $title
    * @property string $optionName
    * @property string $shortDescription
    * @property string $description
    * @property string $specification
    * @property string $width
    * @property string $height
    * @property string $depth
    * @property string $weight
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Brand $brand
            * @property Category $category
            * @property ProductGroup $productGroup
            * @property ProductImage[] $productImages
            * @property ProductPrice[] $productPrices
            * @property ProductPromotion[] $productPromotions
            * @property StoreProduct[] $storeProducts
            * @property StoreProductOrderItem[] $storeProductOrderItems
    */
class ProductMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'productGroupId', 'brandId', 'categoryId', 'status'], 'integer'],
            [['title', 'createDateTime'], 'required'],
            [['shortDescription', 'description', 'specification'], 'string'],
            [['width', 'height', 'depth', 'weight'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['code'], 'string', 'max' => 100],
            [['title', 'optionName'], 'string', 'max' => 200],
            [['brandId'], 'exist', 'skipOnError' => true, 'targetClass' => BrandMaster::className(), 'targetAttribute' => ['brandId' => 'brandId']],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryMaster::className(), 'targetAttribute' => ['categoryId' => 'categoryId']],
            [['productGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupMaster::className(), 'targetAttribute' => ['productGroupId' => 'productGroupId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productId' => Yii::t('product', 'Product ID'),
    'userId' => Yii::t('product', 'User ID'),
    'productGroupId' => Yii::t('product', 'Product Group ID'),
    'brandId' => Yii::t('product', 'Brand ID'),
    'categoryId' => Yii::t('product', 'Category ID'),
    'code' => Yii::t('product', 'Code'),
    'title' => Yii::t('product', 'Title'),
    'optionName' => Yii::t('product', 'Option Name'),
    'shortDescription' => Yii::t('product', 'Short Description'),
    'description' => Yii::t('product', 'Description'),
    'specification' => Yii::t('product', 'Specification'),
    'width' => Yii::t('product', 'Width'),
    'height' => Yii::t('product', 'Height'),
    'depth' => Yii::t('product', 'Depth'),
    'weight' => Yii::t('product', 'Weight'),
    'status' => Yii::t('product', 'Status'),
    'createDateTime' => Yii::t('product', 'Create Date Time'),
    'updateDateTime' => Yii::t('product', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getBrand()
    {
    return $this->hasOne(BrandMaster::className(), ['brandId' => 'brandId']);
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
    return $this->hasOne(ProductGroupMaster::className(), ['productGroupId' => 'productGroupId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductImages()
    {
    return $this->hasMany(ProductImageMaster::className(), ['productId' => 'productId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductPrices()
    {
    return $this->hasMany(ProductPriceMaster::className(), ['productId' => 'productId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductPromotions()
    {
    return $this->hasMany(ProductPromotionMaster::className(), ['productId' => 'productId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getStoreProducts()
    {
    return $this->hasMany(StoreProductMaster::className(), ['productId' => 'productId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getStoreProductOrderItems()
    {
    return $this->hasMany(StoreProductOrderItemMaster::className(), ['productId' => 'productId']);
    }
}
