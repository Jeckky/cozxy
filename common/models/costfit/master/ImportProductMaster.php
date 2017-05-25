<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "import_product".
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
*/
class ImportProductMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'import_product';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productId', 'title', 'createDateTime', 'approvecreateDateTime'], 'required'],
            [['productId', 'userId', 'productGroupId', 'brandId', 'categoryId', 'unit', 'smallUnit', 'status', 'productSuppId', 'approveCreateBy'], 'integer'],
            [['isbn', 'shortDescription', 'description', 'specification'], 'string'],
            [['width', 'height', 'depth', 'weight', 'price'], 'number'],
            [['createDateTime', 'updateDateTime', 'approvecreateDateTime'], 'safe'],
            [['code'], 'string', 'max' => 100],
            [['title', 'optionName'], 'string', 'max' => 200],
            [['tags'], 'string', 'max' => 255],
            [['approve'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productId' => Yii::t('import_product', 'Product ID'),
    'userId' => Yii::t('import_product', 'User ID'),
    'productGroupId' => Yii::t('import_product', 'Product Group ID'),
    'brandId' => Yii::t('import_product', 'Brand ID'),
    'categoryId' => Yii::t('import_product', 'Category ID'),
    'isbn' => Yii::t('import_product', 'Isbn'),
    'code' => Yii::t('import_product', 'Code'),
    'title' => Yii::t('import_product', 'Title'),
    'optionName' => Yii::t('import_product', 'Option Name'),
    'shortDescription' => Yii::t('import_product', 'Short Description'),
    'description' => Yii::t('import_product', 'Description'),
    'specification' => Yii::t('import_product', 'Specification'),
    'width' => Yii::t('import_product', 'Width'),
    'height' => Yii::t('import_product', 'Height'),
    'depth' => Yii::t('import_product', 'Depth'),
    'weight' => Yii::t('import_product', 'Weight'),
    'price' => Yii::t('import_product', 'Price'),
    'unit' => Yii::t('import_product', 'Unit'),
    'smallUnit' => Yii::t('import_product', 'Small Unit'),
    'tags' => Yii::t('import_product', 'Tags'),
    'status' => Yii::t('import_product', 'Status'),
    'createDateTime' => Yii::t('import_product', 'Create Date Time'),
    'updateDateTime' => Yii::t('import_product', 'Update Date Time'),
    'approve' => Yii::t('import_product', 'Approve'),
    'productSuppId' => Yii::t('import_product', 'Product Supp ID'),
    'approveCreateBy' => Yii::t('import_product', 'Approve Create By'),
    'approvecreateDateTime' => Yii::t('import_product', 'Approvecreate Date Time'),
];
}
}
