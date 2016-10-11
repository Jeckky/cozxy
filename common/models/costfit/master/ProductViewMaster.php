<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_view".
*
    * @property string $productViewId
    * @property string $productId
    * @property string $userId
    * @property string $token
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductViewMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_view';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productId', 'createDateTime'], 'required'],
            [['productId', 'userId', 'status'], 'integer'],
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
    'productViewId' => Yii::t('product_view', 'Product View ID'),
    'productId' => Yii::t('product_view', 'Product ID'),
    'userId' => Yii::t('product_view', 'User ID'),
    'token' => Yii::t('product_view', 'Token'),
    'status' => Yii::t('product_view', 'Status'),
    'createDateTime' => Yii::t('product_view', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_view', 'Update Date Time'),
];
}
}
