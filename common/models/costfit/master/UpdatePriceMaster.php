<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "update_price".
*
    * @property integer $updatePriceId
    * @property integer $productPriceOtherWebId
    * @property string $price
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UpdatePriceMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'update_price';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productPriceOtherWebId', 'price'], 'required'],
            [['productPriceOtherWebId', 'status'], 'integer'],
            [['price'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'updatePriceId' => Yii::t('update_price', 'Update Price ID'),
    'productPriceOtherWebId' => Yii::t('update_price', 'Product Price Other Web ID'),
    'price' => Yii::t('update_price', 'Price'),
    'status' => Yii::t('update_price', 'Status'),
    'createDateTime' => Yii::t('update_price', 'Create Date Time'),
    'updateDateTime' => Yii::t('update_price', 'Update Date Time'),
];
}
}
