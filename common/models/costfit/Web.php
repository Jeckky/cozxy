<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\WebMaster;

/**
 * This is the model class for table "web".
 *

 * @property integer $webId

 * @property string $title
 * @property string $company
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Web extends \common\models\costfit\master\WebMaster {

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
