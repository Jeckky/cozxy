<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "store_slot".
*
    * @property string $storeSlotId
    * @property string $storeId
    * @property string $barcode
    * @property string $code
    * @property string $title
    * @property string $description
    * @property string $width
    * @property string $height
    * @property string $depth
    * @property string $weight
    * @property string $maxWeight
    * @property string $parentId
    * @property integer $level
    * @property string $qrCode
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class StoreSlotMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'store_slot';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['storeId', 'barcode', 'title', 'level', 'createDateTime'], 'required'],
            [['storeId', 'parentId', 'level', 'status'], 'integer'],
            [['description'], 'string'],
            [['width', 'height', 'depth', 'weight', 'maxWeight'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['barcode', 'code'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 200],
            [['qrCode'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'storeSlotId' => Yii::t('store_slot', 'Store Slot ID'),
    'storeId' => Yii::t('store_slot', 'Store ID'),
    'barcode' => Yii::t('store_slot', 'Barcode'),
    'code' => Yii::t('store_slot', 'Code'),
    'title' => Yii::t('store_slot', 'Title'),
    'description' => Yii::t('store_slot', 'Description'),
    'width' => Yii::t('store_slot', 'Width'),
    'height' => Yii::t('store_slot', 'Height'),
    'depth' => Yii::t('store_slot', 'Depth'),
    'weight' => Yii::t('store_slot', 'Weight'),
    'maxWeight' => Yii::t('store_slot', 'Max Weight'),
    'parentId' => Yii::t('store_slot', 'Parent ID'),
    'level' => Yii::t('store_slot', 'Level'),
    'qrCode' => Yii::t('store_slot', 'Qr Code'),
    'status' => Yii::t('store_slot', 'Status'),
    'createDateTime' => Yii::t('store_slot', 'Create Date Time'),
    'updateDateTime' => Yii::t('store_slot', 'Update Date Time'),
];
}
}
