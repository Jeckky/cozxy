<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product".
*
    * @property string $productId
    * @property string $supplierId
    * @property string $brandId
    * @property string $brandModelId
    * @property string $categoryId
    * @property string $categoryId2
    * @property string $code
    * @property string $name
    * @property string $isbn
    * @property string $sku
    * @property string $upc
    * @property string $location
    * @property integer $quantity
    * @property string $productUnits
    * @property integer $stockStatusId
    * @property string $image
    * @property integer $shipping
    * @property string $price
    * @property string $otherPrice
    * @property integer $noPerBox
    * @property string $priceGroupId
    * @property string $points
    * @property string $taxClassId
    * @property string $dateAvailable
    * @property string $weight
    * @property string $length
    * @property string $width
    * @property string $height
    * @property string $area
    * @property string $dimensionUnits
    * @property string $metricUnits
    * @property integer $subtract
    * @property string $minimum
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $viewed
    * @property string $marginId
    * @property string $description
    * @property string $payCondition
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
            [['supplierId', 'code', 'quantity', 'productUnits', 'price', 'priceGroupId', 'dateAvailable', 'length', 'width', 'height', 'dimensionUnits', 'metricUnits'], 'required'],
            [['supplierId', 'brandId', 'brandModelId', 'categoryId', 'categoryId2', 'quantity', 'stockStatusId', 'shipping', 'noPerBox', 'priceGroupId', 'points', 'taxClassId', 'subtract', 'minimum', 'sortOrder', 'status', 'viewed', 'marginId'], 'integer'],
            [['price', 'otherPrice', 'weight', 'length', 'width', 'height', 'area'], 'number'],
            [['dateAvailable', 'createDateTime', 'updateDateTime'], 'safe'],
            [['description', 'payCondition'], 'string'],
            [['code', 'isbn'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 80],
            [['sku'], 'string', 'max' => 64],
            [['upc'], 'string', 'max' => 12],
            [['location'], 'string', 'max' => 40],
            [['productUnits', 'dimensionUnits', 'metricUnits'], 'string', 'max' => 45],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productId' => Yii::t('product', 'Product ID'),
    'supplierId' => Yii::t('product', 'Supplier ID'),
    'brandId' => Yii::t('product', 'Brand ID'),
    'brandModelId' => Yii::t('product', 'Brand Model ID'),
    'categoryId' => Yii::t('product', 'Category ID'),
    'categoryId2' => Yii::t('product', 'Category Id2'),
    'code' => Yii::t('product', 'Code'),
    'name' => Yii::t('product', 'Name'),
    'isbn' => Yii::t('product', 'Isbn'),
    'sku' => Yii::t('product', 'Sku'),
    'upc' => Yii::t('product', 'Upc'),
    'location' => Yii::t('product', 'Location'),
    'quantity' => Yii::t('product', 'Quantity'),
    'productUnits' => Yii::t('product', 'Product Units'),
    'stockStatusId' => Yii::t('product', 'Stock Status ID'),
    'image' => Yii::t('product', 'Image'),
    'shipping' => Yii::t('product', 'Shipping'),
    'price' => Yii::t('product', 'Price'),
    'otherPrice' => Yii::t('product', 'Other Price'),
    'noPerBox' => Yii::t('product', 'No Per Box'),
    'priceGroupId' => Yii::t('product', 'Price Group ID'),
    'points' => Yii::t('product', 'Points'),
    'taxClassId' => Yii::t('product', 'Tax Class ID'),
    'dateAvailable' => Yii::t('product', 'Date Available'),
    'weight' => Yii::t('product', 'Weight'),
    'length' => Yii::t('product', 'Length'),
    'width' => Yii::t('product', 'Width'),
    'height' => Yii::t('product', 'Height'),
    'area' => Yii::t('product', 'Area'),
    'dimensionUnits' => Yii::t('product', 'Dimension Units'),
    'metricUnits' => Yii::t('product', 'Metric Units'),
    'subtract' => Yii::t('product', 'Subtract'),
    'minimum' => Yii::t('product', 'Minimum'),
    'sortOrder' => Yii::t('product', 'Sort Order'),
    'status' => Yii::t('product', 'Status'),
    'createDateTime' => Yii::t('product', 'Create Date Time'),
    'updateDateTime' => Yii::t('product', 'Update Date Time'),
    'viewed' => Yii::t('product', 'Viewed'),
    'marginId' => Yii::t('product', 'Margin ID'),
    'description' => Yii::t('product', 'Description'),
    'payCondition' => Yii::t('product', 'Pay Condition'),
];
}
}
