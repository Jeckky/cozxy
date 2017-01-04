<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "furniture_item".
*
    * @property string $furnitureItemId
    * @property string $furnitureId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $plan
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Furniture $furniture
            * @property FurnitureItemSub[] $furnitureItemSubs
    */
class FurnitureItemMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'furniture_item';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['furnitureId', 'title', 'createDateTime'], 'required'],
            [['furnitureId', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image', 'plan'], 'string', 'max' => 255],
            [['furnitureId'], 'exist', 'skipOnError' => true, 'targetClass' => FurnitureMaster::className(), 'targetAttribute' => ['furnitureId' => 'furnitureId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'furnitureItemId' => Yii::t('furniture_item', 'Furniture Item ID'),
    'furnitureId' => Yii::t('furniture_item', 'Furniture ID'),
    'title' => Yii::t('furniture_item', 'Title'),
    'description' => Yii::t('furniture_item', 'Description'),
    'image' => Yii::t('furniture_item', 'Image'),
    'plan' => Yii::t('furniture_item', 'Plan'),
    'status' => Yii::t('furniture_item', 'Status'),
    'createDateTime' => Yii::t('furniture_item', 'Create Date Time'),
    'updateDateTime' => Yii::t('furniture_item', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getFurniture()
    {
    return $this->hasOne(FurnitureMaster::className(), ['furnitureId' => 'furnitureId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getFurnitureItemSubs()
    {
    return $this->hasMany(FurnitureItemSubMaster::className(), ['furnitureItemId' => 'furnitureItemId']);
    }
}
