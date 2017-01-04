<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "furniture_item_sub".
*
    * @property string $furnitureItemSubId
    * @property string $furnitureItemId
    * @property string $code
    * @property string $description
    * @property string $image
    * @property integer $quantity
    * @property string $unit
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property FurnitureItem $furnitureItem
    */
class FurnitureItemSubMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'furniture_item_sub';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['furnitureItemId', 'code', 'quantity', 'unit', 'createDateTime'], 'required'],
            [['furnitureItemId', 'quantity', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['code'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 45],
            [['furnitureItemId'], 'exist', 'skipOnError' => true, 'targetClass' => FurnitureItemMaster::className(), 'targetAttribute' => ['furnitureItemId' => 'furnitureItemId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'furnitureItemSubId' => Yii::t('furniture_item_sub', 'Furniture Item Sub ID'),
    'furnitureItemId' => Yii::t('furniture_item_sub', 'Furniture Item ID'),
    'code' => Yii::t('furniture_item_sub', 'Code'),
    'description' => Yii::t('furniture_item_sub', 'Description'),
    'image' => Yii::t('furniture_item_sub', 'Image'),
    'quantity' => Yii::t('furniture_item_sub', 'Quantity'),
    'unit' => Yii::t('furniture_item_sub', 'Unit'),
    'status' => Yii::t('furniture_item_sub', 'Status'),
    'createDateTime' => Yii::t('furniture_item_sub', 'Create Date Time'),
    'updateDateTime' => Yii::t('furniture_item_sub', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getFurnitureItem()
    {
    return $this->hasOne(FurnitureItemMaster::className(), ['furnitureItemId' => 'furnitureItemId']);
    }
}
