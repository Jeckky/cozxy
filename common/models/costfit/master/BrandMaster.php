<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "brand".
*
    * @property string $brandId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $status
    * @property string $parentId
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Product[] $products
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
            [['title', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['status', 'parentId'], 'integer'],
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
    'title' => Yii::t('brand', 'Title'),
    'description' => Yii::t('brand', 'Description'),
    'image' => Yii::t('brand', 'Image'),
    'status' => Yii::t('brand', 'Status'),
    'parentId' => Yii::t('brand', 'Parent ID'),
    'createDateTime' => Yii::t('brand', 'Create Date Time'),
    'updateDateTime' => Yii::t('brand', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProducts()
    {
    return $this->hasMany(ProductMaster::className(), ['brandId' => 'brandId']);
    }
}
