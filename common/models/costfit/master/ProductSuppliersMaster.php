<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_suppliers".
*
    * @property string $productSuppId
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
    * @property string $unit
    * @property string $smallUnit
    * @property string $tags
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property integer $quantity
    * @property integer $result
    * @property string $approve
    * @property integer $productId
    * @property string $approveCreateBy
    * @property string $approvecreateDateTime
    * @property string $receiveType
    * @property string $url
*/
class ProductSuppliersMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_suppliers';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'productGroupId', 'brandId', 'categoryId', 'unit', 'smallUnit', 'status', 'quantity', 'result', 'productId', 'approveCreateBy'], 'integer'],
            [['isbn', 'shortDescription', 'description', 'specification'], 'string'],
            [['title', 'createDateTime', 'quantity', 'result'], 'required'],
            [['width', 'height', 'depth', 'weight'], 'number'],
            [['createDateTime', 'updateDateTime', 'approvecreateDateTime'], 'safe'],
            [['code', 'suppCode', 'merchantCode'], 'string', 'max' => 100],
            [['title', 'optionName'], 'string', 'max' => 200],
            [['tags', 'url'], 'string', 'max' => 255],
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
    'productSuppId' => Yii::t('product_suppliers', 'Product Supp ID'),
    'userId' => Yii::t('product_suppliers', 'User ID'),
    'productGroupId' => Yii::t('product_suppliers', 'Product Group ID'),
    'brandId' => Yii::t('product_suppliers', 'Brand ID'),
    'categoryId' => Yii::t('product_suppliers', 'Category ID'),
    'isbn' => Yii::t('product_suppliers', 'Isbn'),
    'code' => Yii::t('product_suppliers', 'Code'),
    'suppCode' => Yii::t('product_suppliers', 'Supp Code'),
    'merchantCode' => Yii::t('product_suppliers', 'Merchant Code'),
    'title' => Yii::t('product_suppliers', 'Title'),
    'optionName' => Yii::t('product_suppliers', 'Option Name'),
    'shortDescription' => Yii::t('product_suppliers', 'Short Description'),
    'description' => Yii::t('product_suppliers', 'Description'),
    'specification' => Yii::t('product_suppliers', 'Specification'),
    'width' => Yii::t('product_suppliers', 'Width'),
    'height' => Yii::t('product_suppliers', 'Height'),
    'depth' => Yii::t('product_suppliers', 'Depth'),
    'weight' => Yii::t('product_suppliers', 'Weight'),
    'unit' => Yii::t('product_suppliers', 'Unit'),
    'smallUnit' => Yii::t('product_suppliers', 'Small Unit'),
    'tags' => Yii::t('product_suppliers', 'Tags'),
    'status' => Yii::t('product_suppliers', 'Status'),
    'createDateTime' => Yii::t('product_suppliers', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_suppliers', 'Update Date Time'),
    'quantity' => Yii::t('product_suppliers', 'Quantity'),
    'result' => Yii::t('product_suppliers', 'Result'),
    'approve' => Yii::t('product_suppliers', 'Approve'),
    'productId' => Yii::t('product_suppliers', 'Product ID'),
    'approveCreateBy' => Yii::t('product_suppliers', 'Approve Create By'),
    'approvecreateDateTime' => Yii::t('product_suppliers', 'Approvecreate Date Time'),
    'receiveType' => Yii::t('product_suppliers', 'Receive Type'),
    'url' => Yii::t('product_suppliers', 'Url'),
];
}
}
