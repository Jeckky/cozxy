<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ViewLevelsMaster;

/**
 * This is the model class for table "view_levels".
 *

 * @property integer $viewLevelsId
 * @property string $title
 * @property integer $ordering
 * @property string $rules
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ViewLevels extends \common\models\costfit\master\ViewLevelsMaster {

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
