<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\LedMaster;

/**
 * This is the model class for table "led".
 *
 * @property string $ledId
 * @property string $code
 * @property string $ip
 * @property string $shelf
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Led extends \common\models\costfit\master\LedMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'start', 'end'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
        ]);
    }

    public function getLedItems() {
        return $this->hasMany(LedItem::className(), ['ledId' => 'ledId'])->orderBy("led_item.sortOrder ASC");
    }

    public function createLedItems($ledId) {
        $allColor = LedColor::find()->all();
        $i = 1;
        foreach ($allColor as $color):
            $ledItems = new LedItem();
            $ledItems->ledId = $ledId;
            $ledItems->color = $color->ledColor;
            $ledItems->sortOrder = $i;
            $ledItems->status = 0;
            $ledItems->save(false);
            $i++;
        endforeach;
//        for ($i = 1; $i < 6; $i++):
//
//        endfor;
    }

    public static function variableColor($slot) {
        $led = Led::find()->where("slot='" . $slot . "' and status=1")->one();
        $variableColor = LedColor::find()->where("status=0")->one();
        if (isset($led)) {
            if (isset($variableColor)) {
                $colorItem = LedItem::find()->where("ledId=" . $led->ledId . " and color=" . $variableColor->ledColor . " and status=0 order by sortOrder ASC")->one(); //หาไฟดวงที่ว่างอยู่ (status = 0)
                $ledColor = $variableColor->ledColor;
                $count = count($variableColor);
                while (!isset($colorItem)) {
                    $ledColor++;
                    if ($ledColor == $count) {
                        $ledColor = 1;
                    }
                    $colorItem = LedItem::find()->where("ledId=" . $led->ledId . " and color=" . $ledColor . " and status=0 order by sortOrder ASC")->one();
                }
            }
            //throw new \yii\base\Exception($variableColor->ledColor);
            $variableColor->status = 1;
            $colorItem->status = 1;
            $colorItem->save();
            $variableColor->save();
        }
        return $variableColor;
    }

}
