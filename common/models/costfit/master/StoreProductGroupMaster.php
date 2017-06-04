<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "store_product_group".
*
    * @property string $storeProductGroupId
    * @property string $supplierId
    * @property string $poNo
    * @property string $summary
    * @property string $receiveDate
    * @property integer $receiveBy
    * @property integer $arranger
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class StoreProductGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'store_product_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['supplierId', 'receiveBy', 'arranger', 'status'], 'integer'],
            [['summary'], 'number'],
            [['receiveDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['createDateTime'], 'required'],
            [['poNo'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'storeProductGroupId' => Yii::t('store_product_group', 'Store Product Group ID'),
    'supplierId' => Yii::t('store_product_group', 'Supplier ID'),
    'poNo' => Yii::t('store_product_group', 'Po No'),
    'summary' => Yii::t('store_product_group', 'Summary'),
    'receiveDate' => Yii::t('store_product_group', 'Receive Date'),
    'receiveBy' => Yii::t('store_product_group', 'Receive By'),
    'arranger' => Yii::t('store_product_group', 'Arranger'),
    'status' => Yii::t('store_product_group', 'Status'),
    'createDateTime' => Yii::t('store_product_group', 'Create Date Time'),
    'updateDateTime' => Yii::t('store_product_group', 'Update Date Time'),
];
}
}
