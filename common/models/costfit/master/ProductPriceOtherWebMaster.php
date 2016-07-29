<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_price_other_web".
*
    * @property string $productPriceOtherWebId
    * @property string $productId
    * @property string $webId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ProductPriceOtherWebMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_price_other_web';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productId', 'webId'], 'required'],
            [['productId', 'webId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productPriceOtherWebId' => Yii::t('product_price_other_web', 'Product Price Other Web ID'),
    'productId' => Yii::t('product_price_other_web', 'Product ID'),
    'webId' => Yii::t('product_price_other_web', 'Web ID'),
    'status' => Yii::t('product_price_other_web', 'Status'),
    'createDateTime' => Yii::t('product_price_other_web', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_price_other_web', 'Update Date Time'),
];
}
}
