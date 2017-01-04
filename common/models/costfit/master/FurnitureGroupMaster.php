<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "furniture_group".
*
    * @property string $furnitureGroupId
    * @property string $categoryId
    * @property string $category2Id
    * @property string $title
    * @property string $description
    * @property string $price
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Furniture[] $furnitures
    */
class FurnitureGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'furniture_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['categoryId', 'category2Id', 'title', 'price', 'createDateTime'], 'required'],
            [['categoryId', 'category2Id', 'status'], 'integer'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'furnitureGroupId' => Yii::t('furniture_group', 'Furniture Group ID'),
    'categoryId' => Yii::t('furniture_group', 'Category ID'),
    'category2Id' => Yii::t('furniture_group', 'Category2 ID'),
    'title' => Yii::t('furniture_group', 'Title'),
    'description' => Yii::t('furniture_group', 'Description'),
    'price' => Yii::t('furniture_group', 'Price'),
    'image' => Yii::t('furniture_group', 'Image'),
    'status' => Yii::t('furniture_group', 'Status'),
    'createDateTime' => Yii::t('furniture_group', 'Create Date Time'),
    'updateDateTime' => Yii::t('furniture_group', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getFurnitures()
    {
    return $this->hasMany(FurnitureMaster::className(), ['furnitureGroupId' => 'furnitureGroupId']);
    }
}
