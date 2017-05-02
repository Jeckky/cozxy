<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\BankMaster;

/**
 * This is the model class for table "bank".
 *
 * @property string $bankId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Bank extends \common\models\costfit\master\BankMaster {

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

    public static function bankArray($bankId) {
        $bank = Bank::find()->where("bankId=" . $bankId)->one();
        if (isset($bank) && count($bank) > 0) {
            return $bank;
        } else {
            return '';
        }
    }

}
