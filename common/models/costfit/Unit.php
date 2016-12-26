<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UnitMaster;

/**
 * This is the model class for table "unit".
 *
 * @property string $unitId
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Unit extends \common\models\costfit\master\UnitMaster {

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

    public static function unitName($productSuppId) {
        $productSupp = ProductSuppliers::find()->where("productSuppId=" . $productSuppId)->one();
        if (isset($productSupp) && !empty($productSupp)) {
            if ($productSupp->unit == NULL) {
                return '';
            } else {
                $unit = Unit::find()->where("unitId=" . $productSupp->unit . " and status=1")->one();
            }
            if (isset($unit) && !empty($unit)) {
                return $unit->title;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

}
