<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "store_slot".
*
    * @property string $storeSlotId
    * @property string $storeId
    * @property string $code
    * @property string $title
    * @property string $description
    * @property string $width
    * @property string $height
    * @property string $depth
    * @property string $weight
    * @property string $maxWeight
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Store $store
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
            [['storeId', 'title', 'createDateTime'], 'required'],
            [['storeId', 'status'], 'integer'],
            [['description'], 'string'],
            [['width', 'height', 'depth', 'weight', 'maxWeight'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['code'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 200],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => StoreMaster::className(), 'targetAttribute' => ['storeId' => 'storeId']],
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
    'code' => Yii::t('store_slot', 'Code'),
    'title' => Yii::t('store_slot', 'Title'),
    'description' => Yii::t('store_slot', 'Description'),
    'width' => Yii::t('store_slot', 'Width'),
    'height' => Yii::t('store_slot', 'Height'),
    'depth' => Yii::t('store_slot', 'Depth'),
    'weight' => Yii::t('store_slot', 'Weight'),
    'maxWeight' => Yii::t('store_slot', 'Max Weight'),
    'status' => Yii::t('store_slot', 'Status'),
    'createDateTime' => Yii::t('store_slot', 'Create Date Time'),
    'updateDateTime' => Yii::t('store_slot', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getStore()
    {
    return $this->hasOne(StoreMaster::className(), ['storeId' => 'storeId']);
    }
}
