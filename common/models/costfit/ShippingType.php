<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ShippingTypeMaster;

/**
 * This is the model class for table "shipping_type".
 *
 * @property integer $shippingTypeId
 * @property string $title
 * @property integer $date
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ShippingType extends \common\models\costfit\master\ShippingTypeMaster {

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
