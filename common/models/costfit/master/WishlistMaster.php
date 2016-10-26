<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "wishlist".
*
    * @property string $wishlistId
    * @property string $userId
    * @property integer $productId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class WishlistMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'wishlist';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'productId', 'createDateTime'], 'required'],
            [['userId', 'productId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'wishlistId' => Yii::t('wishlist', 'Wishlist ID'),
    'userId' => Yii::t('wishlist', 'User ID'),
    'productId' => Yii::t('wishlist', 'Product ID'),
    'status' => Yii::t('wishlist', 'Status'),
    'createDateTime' => Yii::t('wishlist', 'Create Date Time'),
    'updateDateTime' => Yii::t('wishlist', 'Update Date Time'),
];
}
}
