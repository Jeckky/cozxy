<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_views".
*
    * @property string $viewId
    * @property string $productSuppId
    * @property string $userId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductViewsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_views';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['viewId', 'createDateTime'], 'required'],
            [['viewId', 'productSuppId', 'userId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'viewId' => Yii::t('product_views', 'View ID'),
    'productSuppId' => Yii::t('product_views', 'Product Supp ID'),
    'userId' => Yii::t('product_views', 'User ID'),
    'status' => Yii::t('product_views', 'Status'),
    'createDateTime' => Yii::t('product_views', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_views', 'Update Date Time'),
];
}
}
