<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_favourite".
*
    * @property string $userFavouriteId
    * @property string $userId
    * @property string $brandId
    * @property string $brandModelId
    * @property string $category1Id
    * @property string $category2Id
    * @property string $productId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserFavouriteMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_favourite';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'createDateTime'], 'required'],
            [['userId', 'brandId', 'brandModelId', 'category1Id', 'category2Id', 'productId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userFavouriteId' => Yii::t('user_favourite', 'User Favourite ID'),
    'userId' => Yii::t('user_favourite', 'User ID'),
    'brandId' => Yii::t('user_favourite', 'Brand ID'),
    'brandModelId' => Yii::t('user_favourite', 'Brand Model ID'),
    'category1Id' => Yii::t('user_favourite', 'Category1 ID'),
    'category2Id' => Yii::t('user_favourite', 'Category2 ID'),
    'productId' => Yii::t('user_favourite', 'Product ID'),
    'status' => Yii::t('user_favourite', 'Status'),
    'createDateTime' => Yii::t('user_favourite', 'Create Date Time'),
    'updateDateTime' => Yii::t('user_favourite', 'Update Date Time'),
];
}
}
