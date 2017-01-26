<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ReturnProductMaster;

/**
 * This is the model class for table "return_product".
 *
 * @property string $returnProdctId
 * @property integer $orderId
 * @property integer $orderItemId
 * @property integer $productSuppId
 * @property integer $quantity
 * @property integer $price
 * @property integer $receiver
 * @property integer $status
 * @property integer $createDateTime
 * @property integer $updateDateTime
 */
class ReturnProduct extends \common\models\costfit\master\ReturnProductMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    public function attributes() {
        return array_merge(parent::attributes(), [
            'invoiceNo',
                /* use end */
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

}
