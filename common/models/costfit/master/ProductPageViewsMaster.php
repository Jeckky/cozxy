<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_page_views".
*
    * @property string $viewId
    * @property string $productSuppId
    * @property string $userId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductPageViewsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_page_views';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productSuppId', 'userId', 'status'], 'integer'],
            [['createDateTime'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'viewId' => Yii::t('product_page_views', 'View ID'),
    'productSuppId' => Yii::t('product_page_views', 'Product Supp ID'),
    'userId' => Yii::t('product_page_views', 'User ID'),
    'status' => Yii::t('product_page_views', 'Status'),
    'createDateTime' => Yii::t('product_page_views', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_page_views', 'Update Date Time'),
];
}
}
