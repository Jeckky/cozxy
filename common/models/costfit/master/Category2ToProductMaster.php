<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "category2_to_product".
*
    * @property string $id
    * @property string $brandId
    * @property string $brandModelId
    * @property string $category1Id
    * @property string $category2Id
    * @property string $productId
    * @property string $groupName
    * @property integer $quantity
    * @property integer $type
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class Category2ToProductMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'category2_to_product';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['brandId', 'brandModelId', 'category1Id', 'category2Id', 'productId', 'quantity', 'type', 'sortOrder', 'status'], 'integer'],
            [['productId', 'createDateTime'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['groupName'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('category2_to_product', 'ID'),
    'brandId' => Yii::t('category2_to_product', 'Brand ID'),
    'brandModelId' => Yii::t('category2_to_product', 'Brand Model ID'),
    'category1Id' => Yii::t('category2_to_product', 'Category1 ID'),
    'category2Id' => Yii::t('category2_to_product', 'Category2 ID'),
    'productId' => Yii::t('category2_to_product', 'Product ID'),
    'groupName' => Yii::t('category2_to_product', 'Group Name'),
    'quantity' => Yii::t('category2_to_product', 'Quantity'),
    'type' => Yii::t('category2_to_product', 'Type'),
    'sortOrder' => Yii::t('category2_to_product', 'Sort Order'),
    'status' => Yii::t('category2_to_product', 'Status'),
    'createDateTime' => Yii::t('category2_to_product', 'Create Date Time'),
    'updateDateTime' => Yii::t('category2_to_product', 'Update Date Time'),
];
}
}
