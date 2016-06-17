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
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'storeId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'storeSlotId' => 'Store Slot ID',
            'storeId' => 'Store ID',
            'code' => 'Code',
            'title' => 'Title',
            'description' => 'Description',
            'width' => 'Width',
            'height' => 'Height',
            'depth' => 'Depth',
            'weight' => 'Weight',
            'maxWeight' => 'Max Weight',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['storeId' => 'storeId']);
    }
}
