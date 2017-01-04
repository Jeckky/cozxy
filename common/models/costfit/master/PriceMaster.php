<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "price".
*
    * @property string $priceId
    * @property string $priceGroupId
    * @property string $provinceId
    * @property string $amphurId
    * @property string $priceRate
    * @property integer $status
*/
class PriceMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'price';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['priceGroupId', 'provinceId', 'amphurId', 'priceRate'], 'required'],
            [['priceGroupId', 'provinceId', 'amphurId', 'status'], 'integer'],
            [['priceRate'], 'number'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'priceId' => Yii::t('price', 'Price ID'),
    'priceGroupId' => Yii::t('price', 'Price Group ID'),
    'provinceId' => Yii::t('price', 'Province ID'),
    'amphurId' => Yii::t('price', 'Amphur ID'),
    'priceRate' => Yii::t('price', 'Price Rate'),
    'status' => Yii::t('price', 'Status'),
];
}
}
