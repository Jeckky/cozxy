<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "brand_image".
*
    * @property string $brandImageId
    * @property string $brandId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Brand $brand
    */
class BrandImageMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'brand_image';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['brandId', 'createDateTime'], 'required'],
            [['brandId', 'sortOrder', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
            [['brandId'], 'exist', 'skipOnError' => true, 'targetClass' => BrandMaster::className(), 'targetAttribute' => ['brandId' => 'brandId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'brandImageId' => Yii::t('brand_image', 'Brand Image ID'),
    'brandId' => Yii::t('brand_image', 'Brand ID'),
    'title' => Yii::t('brand_image', 'Title'),
    'description' => Yii::t('brand_image', 'Description'),
    'image' => Yii::t('brand_image', 'Image'),
    'sortOrder' => Yii::t('brand_image', 'Sort Order'),
    'status' => Yii::t('brand_image', 'Status'),
    'createDateTime' => Yii::t('brand_image', 'Create Date Time'),
    'updateDateTime' => Yii::t('brand_image', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getBrand()
    {
    return $this->hasOne(BrandMaster::className(), ['brandId' => 'brandId']);
    }
}
