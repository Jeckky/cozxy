<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "brand".
*
    * @property string $brandId
    * @property string $supplierId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property BrandImage[] $brandImages
    */
class BrandMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'brand';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['supplierId', 'title', 'createDateTime'], 'required'],
            [['supplierId', 'sortOrder', 'status'], 'integer'],
            [['description'], 'string'],
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
    'brandId' => Yii::t('brand', 'Brand ID'),
    'supplierId' => Yii::t('brand', 'Supplier ID'),
    'title' => Yii::t('brand', 'Title'),
    'description' => Yii::t('brand', 'Description'),
    'image' => Yii::t('brand', 'Image'),
    'sortOrder' => Yii::t('brand', 'Sort Order'),
    'status' => Yii::t('brand', 'Status'),
    'createDateTime' => Yii::t('brand', 'Create Date Time'),
    'updateDateTime' => Yii::t('brand', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getBrandImages()
    {
    return $this->hasMany(BrandImageMaster::className(), ['brandId' => 'brandId']);
    }
}
