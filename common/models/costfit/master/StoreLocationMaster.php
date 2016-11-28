<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "store_location".
*
    * @property string $storeLocationId
    * @property string $storeId
    * @property integer $provinceId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class StoreLocationMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'store_location';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['storeId', 'createDateTime'], 'required'],
            [['storeId', 'provinceId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'storeLocationId' => Yii::t('store_location', 'Store Location ID'),
    'storeId' => Yii::t('store_location', 'Store ID'),
    'provinceId' => Yii::t('store_location', 'Province ID'),
    'status' => Yii::t('store_location', 'Status'),
    'createDateTime' => Yii::t('store_location', 'Create Date Time'),
    'updateDateTime' => Yii::t('store_location', 'Update Date Time'),
];
}
}
