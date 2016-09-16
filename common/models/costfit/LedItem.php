<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\LedItemMaster;

/**
 * This is the model class for table "led_item".
 *
 * @property string $ledItemId
 * @property integer $ledId
 * @property integer $color
 * @property integer $sortOrder
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class LedItem extends \common\models\costfit\master\LedItemMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'sortOrder' => 'ลำดับการแสดงผล',
        ]);
    }

}
