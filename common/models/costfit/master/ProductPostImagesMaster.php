<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_post_images".
*
    * @property string $imagesId
    * @property string $productPostId
    * @property string $picture
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductPostImagesMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_post_images';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productPostId', 'createDateTime'], 'required'],
            [['productPostId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['picture'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'imagesId' => Yii::t('product_post_images', 'Images ID'),
    'productPostId' => Yii::t('product_post_images', 'Product Post ID'),
    'picture' => Yii::t('product_post_images', 'Picture'),
    'status' => Yii::t('product_post_images', 'Status'),
    'createDateTime' => Yii::t('product_post_images', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_post_images', 'Update Date Time'),
];
}
}
