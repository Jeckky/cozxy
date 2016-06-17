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
 *
 * @property Store $store
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
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'storeId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'storeLocationId' => 'Store Location ID',
            'storeId' => 'Store ID',
            'provinceId' => 'Province ID',
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
