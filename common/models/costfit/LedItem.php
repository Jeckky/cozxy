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
class LedItem extends \common\models\costfit\master\LedItemMaster
{

    /**
     * @inheritdoc
     */
    const COLOR_RED = 1;
    const COLOR_YELLOW = 2;
    const COLOR_BLUE = 3;
    const COLOR_PINK = 4;
    const COLOR_GREEN = 5;
    const COLOR_ORANGE = 6;
    const COLOR_SKY_BLUE = 7;
    const COLOR_WHITE = 8;

    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'sortOrder' => 'ลำดับการแสดงผล',
        ]);
    }

    public function getColorArray()
    {
        return[
            self::COLOR_RED => '#f51e50',
            self::COLOR_YELLOW => '#f5ed1e',
            self::COLOR_BLUE => '#2c9bd5',
            self::COLOR_PINK => '#d32cd5',
            self::COLOR_GREEN => '#2cd540',
            self::COLOR_ORANGE => '#e7963f',
            self::COLOR_SKY_BLUE => '#3fe7e5',
            self::COLOR_WHITE => '#f8ebfb'
        ];
    }

    public function getColorText($color)
    {
        $res = $this->getColorArray();
        if (isset($res[$color])) {
            return $res[$color];
        } else {
            return "#000000";
        }
    }

    public function getLeds()
    {

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

    public static function allColor($ledId)
    {
        $show = '';
        $color = LedColor::find()->where("ledColor=" . $ledId)->one();
        if (isset($color)) {
            $show = $color->htmlCode;
        }
        return $show;
    }

    public function getLedColor()
    {
        return $this->hasOne(LedColor::className(), ['ledColorId' => 'color']);
    }

    public function getLed()
    {
        return $this->hasOne(Led::className(), ['ledId' => 'ledId']);
    }

}
