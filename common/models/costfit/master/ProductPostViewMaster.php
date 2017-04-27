<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_post_view".
*
    * @property string $productPostViewId
    * @property string $productPostId
    * @property string $userId
    * @property string $token
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductPostViewMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_post_view';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productPostId', 'createDateTime'], 'required'],
            [['productPostId', 'userId', 'status'], 'integer'],
            [['token'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productPostViewId' => Yii::t('product_post_view', 'Product Post View ID'),
    'productPostId' => Yii::t('product_post_view', 'Product Post ID'),
    'userId' => Yii::t('product_post_view', 'User ID'),
    'token' => Yii::t('product_post_view', 'Token'),
    'status' => Yii::t('product_post_view', 'Status'),
    'createDateTime' => Yii::t('product_post_view', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_post_view', 'Update Date Time'),
];
}
}
