<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PickingPointItemsMaster;

/**
 * This is the model class for table "picking_point_items".
 *
 * @property string $pickingItemsId

 * @property integer $pickingId
 * @property string $name

 */
class PickingPointItems extends \common\models\costfit\master\PickingPointItemsMaster {

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

    public function getPickingPoint() {
        return $this->hasOne(PickingPoint::className(), ['pickingId' => 'pickingId']);
    }

}
