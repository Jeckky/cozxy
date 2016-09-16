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

    public function getLeds() {

        $query = new \yii\db\Query();
        $query->select('*')
                ->from('led_item')
                ->join('INNER JOIN', 'led', 'led.ledId = led_item.ledId')
                ->where(['led.status' => 1])
                ->orderBy('led_item.color asc ,`led`.`slot` asc  ');

        $command = $query->createCommand();
        $data = $command->queryAll();
        return $data;

        //return $this->hasOne(Led::className(), ['ledId' => 'ledId']);
    }

}
