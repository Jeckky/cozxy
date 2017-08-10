<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_shelf".
*
    * @property string $productShelfId
    * @property string $title
    * @property integer $type
    * @property integer $userId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductShelfMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_shelf';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title', 'userId'], 'required'],
            [['type', 'userId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 100],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productShelfId' => Yii::t('product_shelf', 'Product Shelf ID'),
    'title' => Yii::t('product_shelf', 'Title'),
    'type' => Yii::t('product_shelf', 'Type'),
    'userId' => Yii::t('product_shelf', 'User ID'),
    'status' => Yii::t('product_shelf', 'Status'),
    'createDateTime' => Yii::t('product_shelf', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_shelf', 'Update Date Time'),
];
}
}
