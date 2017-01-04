<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "price_group".
*
    * @property string $priceGroupId
    * @property string $priceGroupName
    * @property string $priceRate
    * @property integer $status
    * @property string $supplierId
*/
class PriceGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'price_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['priceGroupName', 'priceRate', 'supplierId'], 'required'],
            [['priceRate'], 'number'],
            [['status', 'supplierId'], 'integer'],
            [['priceGroupName'], 'string', 'max' => 40],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'priceGroupId' => Yii::t('price_group', 'Price Group ID'),
    'priceGroupName' => Yii::t('price_group', 'Price Group Name'),
    'priceRate' => Yii::t('price_group', 'Price Rate'),
    'status' => Yii::t('price_group', 'Status'),
    'supplierId' => Yii::t('price_group', 'Supplier ID'),
];
}
}
