<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderItemPackingItemsMaster;

/**
 * This is the model class for table "order_item_packing_items".
 *
 * @property string $remarkId
 * @property string $orderItemPackingId
 * @property string $desc
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class OrderItemPackingItems extends \common\models\costfit\master\OrderItemPackingItemsMaster {

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
