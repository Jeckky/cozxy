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
    * @property string $suppCode
    * @property string $merchantCode
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
    * @property string $receiveType
    *
            * @property ProductPromotion[] $productPromotions
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
            [['title', 'createDateTime'], 'required'],
            [['width', 'height', 'depth', 'weight', 'price'], 'number'],
            [['createDateTime', 'updateDateTime', 'approvecreateDateTime'], 'safe'],
            [['code', 'suppCode', 'merchantCode'], 'string', 'max' => 100],
            [['title', 'optionName'], 'string', 'max' => 200],
            [['tags'], 'string', 'max' => 255],
            [['approve'], 'string', 'max' => 10],
            [['receiveType'], 'string', 'max' => 45],
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
    'suppCode' => Yii::t('product', 'Supp Code'),
    'merchantCode' => Yii::t('product', 'Merchant Code'),
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
    'receiveType' => Yii::t('product', 'Receive Type'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductPromotions()
    {
    return $this->hasMany(ProductPromotionMaster::className(), ['productId' => 'productId']);
    }
}
