<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\StoreSlotMaster;

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
class StoreSlot extends \common\models\costfit\master\StoreSlotMaster {

    /**
     * @inheritdoc
     */
    const LEVEL_SHELF = 1;
    const LEVEL_SHELF_FLOOR = 2;
    const LEVEL_SHELF_FLOOR_SLOT = 3;

    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getLevelArray() {
        return [
            self::LEVEL_SHELF => 'ROW',
            self::LEVEL_SHELF_FLOOR => 'COLUMN',
            self::LEVEL_SHELF_FLOOR_SLOT => 'SLOT',
        ];
    }

    public function getLevelText($level) {
        $res = $this->getLevelArray();
        if (isset($res[$level])) {
            return $res[$level];
        } else {
            return NULL;
        }
    }

    public function getCols() {
        return $this->hasMany(StoreSlot::className(), ['parentId' => 'storeSlotId'])->where(['level' => 2]);
    }

    public function getSlots() {
        return $this->hasMany(StoreSlot::className(), ['parentId' => 'storeSlotId'])->where(['level' => 3]);
    }

    public static function getSlotsFromRow($rowId) {
        return StoreSlot::find()
        ->join("LEFT JOIN", 'store_slot col', 'col.storeSlotId=store_slot.parentId')
        ->join("LEFT JOIN", 'store_slot row', 'row.storeSlotId=col.parentId')
        ->where("row.storeSlotId=$rowId and store_slot.level =3")
        ->orderBy("store_slot.code DESC")
        ->groupBy("store_slot.code")
        ->all();
    }

    public static function getSlotName($slotId) {
        $slot = StoreSlot::find()->where("storeSlotId=" . $slotId)->one();
        return $slot->barcode;
    }

}
