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
    * @property string $isbn
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
    * @property string $price
    * @property string $unit
    * @property string $smallUnit
    * @property string $tags
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $approve
    * @property string $productSuppId
    * @property string $approveCreateBy
    * @property string $approvecreateDateTime
    *
            * @property OrderItem[] $orderItems
            * @property Brand $brand
            * @property Category $category
            * @property ProductGroup $productGroup
            * @property Unit $smallUnit0
            * @property Unit $unit0
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
            [['userId', 'productGroupId', 'brandId', 'categoryId', 'unit', 'smallUnit', 'status', 'productSuppId', 'approveCreateBy'], 'integer'],
            [['isbn', 'shortDescription', 'description', 'specification'], 'string'],
            [['title', 'createDateTime', 'approvecreateDateTime'], 'required'],
            [['width', 'height', 'depth', 'weight', 'price'], 'number'],
            [['createDateTime', 'updateDateTime', 'approvecreateDateTime'], 'safe'],
            [['code'], 'string', 'max' => 100],
            [['title', 'optionName'], 'string', 'max' => 200],
            [['tags'], 'string', 'max' => 255],
            [['approve'], 'string', 'max' => 10],
            [['brandId'], 'exist', 'skipOnError' => true, 'targetClass' => BrandMaster::className(), 'targetAttribute' => ['brandId' => 'brandId']],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryMaster::className(), 'targetAttribute' => ['categoryId' => 'categoryId']],
            [['productGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupMaster::className(), 'targetAttribute' => ['productGroupId' => 'productGroupId']],
            [['smallUnit'], 'exist', 'skipOnError' => true, 'targetClass' => UnitMaster::className(), 'targetAttribute' => ['smallUnit' => 'unitId']],
            [['unit'], 'exist', 'skipOnError' => true, 'targetClass' => UnitMaster::className(), 'targetAttribute' => ['unit' => 'unitId']],
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
    'isbn' => Yii::t('product', 'Isbn'),
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
    'price' => Yii::t('product', 'Price'),
    'unit' => Yii::t('product', 'Unit'),
    'smallUnit' => Yii::t('product', 'Small Unit'),
    'tags' => Yii::t('product', 'Tags'),
    'status' => Yii::t('product', 'Status'),
    'createDateTime' => Yii::t('product', 'Create Date Time'),
    'updateDateTime' => Yii::t('product', 'Update Date Time'),
    'approve' => Yii::t('product', 'Approve'),
    'productSuppId' => Yii::t('product', 'Product Supp ID'),
    'approveCreateBy' => Yii::t('product', 'Approve Create By'),
    'approvecreateDateTime' => Yii::t('product', 'Approvecreate Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getOrderItems()
    {
    return $this->hasMany(OrderItemMaster::className(), ['productId' => 'productId']);
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
    public function getSmallUnit0()
    {
    return $this->hasOne(UnitMaster::className(), ['unitId' => 'smallUnit']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUnit0()
    {
    return $this->hasOne(UnitMaster::className(), ['unitId' => 'unit']);
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
