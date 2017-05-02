<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_group".
*
    * @property string $productGroupId
    * @property string $userId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productGroupId', 'userId', 'title', 'createDateTime'], 'required'],
            [['productGroupId', 'userId', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productGroupId' => Yii::t('product_group', 'Product Group ID'),
    'userId' => Yii::t('product_group', 'User ID'),
    'title' => Yii::t('product_group', 'Title'),
    'description' => Yii::t('product_group', 'Description'),
    'status' => Yii::t('product_group', 'Status'),
    'createDateTime' => Yii::t('product_group', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_group', 'Update Date Time'),
];
}
}
