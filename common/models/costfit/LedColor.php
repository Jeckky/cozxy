<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\LedColorMaster;

/**
 * This is the model class for table "led_color".
 *

 * @property integer $ledColorId
 * @property integer $ledColor
 * @property string $htmlCode
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class LedColor extends \common\models\costfit\master\LedColorMaster {

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
        return array_merge(parent::attributeLabels(), []);
    }

}
