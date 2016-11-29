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
    const COLOR_GREEN = 1;
    const COLOR_RED = 2;
    const COLOR_BLUE = 3;
    const COLOR_PINK = 4;
    const COLOR_YELLOW = 5;

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

    public function getColorArray() {
        return[
            self::COLOR_GREEN => ' text-success',
            self::COLOR_RED => ' text-danger',
            self::COLOR_BLUE => ' text-primary',
            self::COLOR_PINK => ' text-pink',
            self::COLOR_YELLOW => ' text-warning'
        ];
    }

    public function getColorText($color) {
        $res = $this->getColorArray();
        if (isset($res[$color])) {
            return $res[$color];
        } else {
            return "text-default";
        }
    }

    public function getLeds() {

        $query = new \yii\db\Query();
        $query->select('*')
                ->from('led_item')
                ->join('INNER JOIN', 'led', 'led.ledId = led_item.ledId')
                ->where(['led.status' => 1])
                ->orderBy('`led`.`ledId` asc  ,led_item.sortOrder asc ');

        $command = $query->createCommand();
        $data = $command->queryAll();
        return $data;

        //return $this->hasOne(Led::className(), ['ledId' => 'ledId']);
    }

    public static function allColor($ledId) {
        $show = '';
        $color = LedColor::find()->where("ledColor=" . $ledId)->one();
        if (isset($color)) {
            $show = $color->htmlCode;
        }
        return $show;
    }

}
