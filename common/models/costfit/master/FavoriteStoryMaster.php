<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "favorite_story".
*
    * @property string $favoriteStoryId
    * @property integer $productPostId
    * @property integer $productId
    * @property integer $userId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class FavoriteStoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'favorite_story';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productPostId', 'productId', 'userId'], 'required'],
            [['productPostId', 'productId', 'userId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'favoriteStoryId' => Yii::t('favorite_story', 'Favorite Story ID'),
    'productPostId' => Yii::t('favorite_story', 'Product Post ID'),
    'productId' => Yii::t('favorite_story', 'Product ID'),
    'userId' => Yii::t('favorite_story', 'User ID'),
    'status' => Yii::t('favorite_story', 'Status'),
    'createDateTime' => Yii::t('favorite_story', 'Create Date Time'),
    'updateDateTime' => Yii::t('favorite_story', 'Update Date Time'),
];
}
}
