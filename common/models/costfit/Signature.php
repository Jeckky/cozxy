<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\SignatureMaster;

/**
 * This is the model class for table "signature".
 *
 * @property integer $signatureId
 * @property integer $userId
 * @property string $image
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Signature extends \common\models\costfit\master\SignatureMaster {

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

    public static function directorSignature() {
        $signature = Signature::find()->where("position='director'")->one();
        if (isset($signature)) {
            return $signature->image;
        } else {
            return '';
        }
    }

    public static function approveSignature($userId) {
        $signature = Signature::find()->where("userId=" . $userId)->one();
        if (isset($signature)) {
            return $signature->image;
        } else {
            return '';
        }
    }

    public static function financialSignature() {
        $signature = Signature::find()->where("position='finance'")->one();
        if (isset($signature)) {
            return $signature->image;
        } else {
            return '';
        }
    }

}
