<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ConfigurationMaster;

/**
 * This is the model class for table "configuration".
 *

 * @property integer $configurationId

 * @property string $title
 * @property string $description
 * @property string $value
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Configuration extends \common\models\costfit\master\ConfigurationMaster {

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
