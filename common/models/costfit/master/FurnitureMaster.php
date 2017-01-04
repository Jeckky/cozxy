<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "furniture".
*
    * @property string $furnitureId
    * @property string $furnitureGroupId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property FurnitureGroup $furnitureGroup
            * @property FurnitureItem[] $furnitureItems
    */
class FurnitureMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'furniture';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['furnitureGroupId', 'title', 'createDateTime'], 'required'],
            [['furnitureGroupId', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
            [['furnitureGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => FurnitureGroupMaster::className(), 'targetAttribute' => ['furnitureGroupId' => 'furnitureGroupId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'furnitureId' => Yii::t('furniture', 'Furniture ID'),
    'furnitureGroupId' => Yii::t('furniture', 'Furniture Group ID'),
    'title' => Yii::t('furniture', 'Title'),
    'description' => Yii::t('furniture', 'Description'),
    'image' => Yii::t('furniture', 'Image'),
    'status' => Yii::t('furniture', 'Status'),
    'createDateTime' => Yii::t('furniture', 'Create Date Time'),
    'updateDateTime' => Yii::t('furniture', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getFurnitureGroup()
    {
    return $this->hasOne(FurnitureGroupMaster::className(), ['furnitureGroupId' => 'furnitureGroupId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getFurnitureItems()
    {
    return $this->hasMany(FurnitureItemMaster::className(), ['furnitureId' => 'furnitureId']);
    }
}
