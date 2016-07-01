<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "category_to_product".
*
    * @property string $id
    * @property string $categoryId
    * @property string $productId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CategoryToProductMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'category_to_product';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['categoryId', 'productId', 'createDateTime'], 'required'],
            [['categoryId', 'productId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('category_to_product', 'ID'),
    'categoryId' => Yii::t('category_to_product', 'Category ID'),
    'productId' => Yii::t('category_to_product', 'Product ID'),
    'status' => Yii::t('category_to_product', 'Status'),
    'createDateTime' => Yii::t('category_to_product', 'Create Date Time'),
    'updateDateTime' => Yii::t('category_to_product', 'Update Date Time'),
];
}
}
