<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CurrencyMaster;

/**
 * This is the model class for table "currency".
 *
 * @property string $currencyId
 * @property string $title
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Currency extends \common\models\costfit\master\CurrencyMaster {

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

    public static function acronym($currencyId) {
        $currency = Currency::find()->where("currencyId=" . $currencyId)->one();
        $acronym = '';
        if (isset($currency)) {
            $acronym = $currency->acronym;
        }
        return $acronym;
    }

    public static function ToThb($currencyId, $price) {
        if (isset($currencyId)) {
            $currency = Currency::find()->where("currencyId=" . $currencyId)->one();
            if (isset($currency)) {
                $thb = $currency->toThb * $price;
            } else {
                $thb = $price;
            }
        } else {
            $thb = 0;
        }

        return $thb;
    }

}
