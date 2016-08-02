<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UpdatePriceMaster;

/**
 * This is the model class for table "update_price".
 *

 * @property integer $updatePriceId
 * @property integer $productPriceOtherWebId

 * @property string $price
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class UpdatePrice extends \common\models\costfit\master\UpdatePriceMaster {

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
