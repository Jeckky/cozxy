<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PickingPointTypeMaster;

/**
 * This is the model class for table "picking_point_type".
 *
 * @property string $pptId
 * @property string $name
 * @property string $description
 * @property string $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class PickingPointType extends \common\models\costfit\master\PickingPointTypeMaster {

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
