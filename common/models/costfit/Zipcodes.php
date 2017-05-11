<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ZipcodesMaster;

/**
 * This is the model class for table "zipcodes".
 *
 * @property string $zipcodeId
 * @property string $districtCode
 * @property string $zipcode
 */
class Zipcodes extends \common\models\costfit\master\ZipcodesMaster {

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
