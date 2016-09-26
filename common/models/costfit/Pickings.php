<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PickingsMaster;

/**
 * This is the model class for table "pickings".
 *

 * @property integer $pickingsId
 * @property integer $pickingId

 * @property string $userId
 * @property string $status
 * @property string $isDefault
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Pickings extends \common\models\costfit\master\PickingsMaster {

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

    public function getpickingPoint() {
        return $this->hasOne(\common\models\costfit\PickingPoint::className(), ['pickingId' => 'pickingId']);
    }

    public function getCitie() {
        return $this->hasOne(\common\models\dbworld\Cities::className(), ['cityId' => 'amphurId']);
    }

    public function getCountrie() {
        return $this->hasOne(\common\models\dbworld\Countries::className(), ['countryId' => 'countryId']);
    }

    public function getDistrict() {
        return $this->hasOne(\common\models\dbworld\District::className(), ['districtId' => 'districtId']);
    }

    public function getState() {
        return $this->hasOne(\common\models\dbworld\States::className(), ['stateId' => 'provinceId']);
    }

}
