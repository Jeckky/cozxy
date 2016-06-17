<?php

namespace common\models\costfit\master;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property string $storeId
 * @property string $regionId
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property Region $region
 * @property StoreLocation[] $storeLocations
 * @property StoreProduct[] $storeProducts
 * @property StoreSlot[] $storeSlots
 */
class StoreMaster extends \common\models\ModelMaster
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['regionId', 'status'], 'integer'],
            [['title', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['regionId'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['regionId' => 'regionId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'storeId' => 'Store ID',
            'regionId' => 'Region ID',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['regionId' => 'regionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreLocations()
    {
        return $this->hasMany(StoreLocation::className(), ['storeId' => 'storeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts()
    {
        return $this->hasMany(StoreProduct::className(), ['storeId' => 'storeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStoreSlots()
    {
        return $this->hasMany(StoreSlot::className(), ['storeId' => 'storeId']);
    }
}
