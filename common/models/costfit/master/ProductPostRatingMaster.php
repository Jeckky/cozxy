<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_post_rating".
*
    * @property string $productPostRatingId
    * @property string $productPostId
    * @property string $userId
    * @property integer $score
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductPostRatingMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_post_rating';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productPostId', 'userId', 'score', 'createDateTime'], 'required'],
            [['productPostId', 'userId', 'score', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productPostRatingId' => Yii::t('product_post_rating', 'Product Post Rating ID'),
    'productPostId' => Yii::t('product_post_rating', 'Product Post ID'),
    'userId' => Yii::t('product_post_rating', 'User ID'),
    'score' => Yii::t('product_post_rating', 'Score'),
    'status' => Yii::t('product_post_rating', 'Status'),
    'createDateTime' => Yii::t('product_post_rating', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_post_rating', 'Update Date Time'),
];
}
}
