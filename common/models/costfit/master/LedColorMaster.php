<?php

namespace common\models\costfit\master;

use Yii;

/**
 * This is the model class for table "led_color".
 *
  <<<<<<< HEAD
 * @property integer $ledColorId
 * @property integer $ledColor
 * @property string $htmlCode
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class LedColorMaster extends \common\models\ModelMaster {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'led_color';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ledColor', 'htmlCode'], 'required'],
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['ledColor', 'htmlCode'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ledColorId' => Yii::t('led_color', 'Led Color ID'),
            'ledColor' => Yii::t('led_color', 'Led Color'),
            'htmlCode' => Yii::t('led_color', 'Html Code'),
            'status' => Yii::t('led_color', 'Status'),
            'createDateTime' => Yii::t('led_color', 'Create Date Time'),
            'updateDateTime' => Yii::t('led_color', 'Update Date Time'),
        ];
    }

}
