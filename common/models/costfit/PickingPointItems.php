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

    static function PickingPointDistinct($pickingItemId) {
        $result = OrderItemPacking::find()->where("pickingItemsId  =" . $pickingItemId . ' and status = 8 ')->one();
        if (count($result) > 0) {
            $result = FALSE; // มี pickingItemId แล้ว
        } else {
            $result = OrderItemPacking::find()->where("pickingItemsId  =" . $pickingItemId . ' and status < 8 ')->one();
            if (count($result) > 0) {
                $result = TRUE; // มี pickingItemId แล้ว
            } else {
                $result = FALSE; // มี pickingItemId แล้ว
            }
            //$result = TRUE; // มี pickingItemId แล้ว
        }
        // if ($result['status'] == 8) {
        //$result = TRUE; // มี pickingItemId แล้ว
        //} else {
        //$result = FALSE; // มี pickingItemId แล้ว
        // }
        /*
          if (count($result) > 0) {
          $result = TRUE; // มี pickingItemId แล้ว
          } else {
          $result = FALSE; // มี pickingItemId แล้ว
          }
         * */
        return $result;
    }

    static function PickingPointDistinctCount($pickingItemId) {
        $result = OrderItemPacking::find()->where("pickingItemsId  =" . $pickingItemId)->count();

        return $result;
    }

}
