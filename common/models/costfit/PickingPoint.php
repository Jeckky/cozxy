<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PickingPointMaster;

/**
 * This is the model class for table "picking_point".
 *
 * @property string $pickingId
 * @property string $title
 * @property string $countryId
 * @property string $provinceId
 * @property string $amphurId
 * @property integer $status
 * @property integer $isDefault
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class PickingPoint extends \common\models\costfit\master\PickingPointMaster {

    const TYPE_PICKINGPOINT = 1; // point

    /**
     * @inheritdoc
     */

    public function rules() {
        return array_merge(parent::rules(), [
            [ [ 'provinceId', 'amphurId', 'type', 'isDefault']
                , 'required', 'on' => 'picking_point'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getCities() {
        return $this->hasOne(\common\models\dbworld\Cities::className(), ['cityId' => 'amphurId']);
    }

    public function getCountries() {
        return $this->hasOne(\common\models\dbworld\Countries::className(), ['countryId' => 'countryId']);
    }

    public function getDistrict() {
        return $this->hasOne(\common\models\dbworld\District::className(), ['districtId' => 'districtId']);
    }

    public function getStates() {
        return $this->hasOne(\common\models\dbworld\States::className(), ['stateId' => 'provinceId']);
    }

}
