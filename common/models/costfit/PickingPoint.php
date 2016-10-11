<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PickingPointMaster;

/**
 * This is the model class for table "picking_point".
 *

 * @property string $pickingId

 * @property string $title
 * @property string $countryId
 * @property string $provinceId
 * @property string $amphurId
 * @property integer $status

 * @property integer $type

 * @property integer $isDefault
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class PickingPoint extends \common\models\costfit\master\PickingPointMaster
{

    const TYPE_PICKINGPOINT = 1; // point

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['provinceId', 'amphurId', 'type', 'isDefault']
                , 'required', 'on' => 'picking_point'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), [
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getCitie()
    {
        return $this->hasOne(\common\models\dbworld\Cities::className(), ['cityId' => 'amphurId']);
    }

    public function getCountrie()
    {
        return $this->hasOne(\common\models\dbworld\Countries::className(), ['countryId' => 'countryId']);
    }

    public function getDistrict()
    {
        return $this->hasOne(\common\models\dbworld\District::className(), ['districtId' => 'districtId']);
    }

    public function getState()
    {
        return $this->hasOne(\common\models\dbworld\States::className(), ['stateId' => 'provinceId']);
    }

    static public function findPickingPoitItem($orderId)
    {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (isset($order)) {
            $pickingPoint = PickingPoint::find()->where("pickingId=" . $order->pickingId)->one();
            if (isset($pickingPoint)) {
                $pickingSlot = PickingPointItems::find()->where("pickingId=" . $pickingPoint->pickingId . " and status=1 order by pickingItemsId ASC")->one();
                if (isset($pickingSlot)) {
                    return $pickingPoint->title . ",  ช่องที่  " . $pickingSlot->code;
                } else {
                    return 'ไม่มีช่องว่างที่จุดนี้';
                }
            } else {
                return 'ไม่พบจุดส่งสินค้า';
            }
        } else {
            return 'ไม่พบรายการ Order';
        }
    }

    public function getPickingPointItems()
    {
        return $this->hasMany(\common\models\costfit\PickingPointItems::className(), ['pickingId' => 'pickingId']);
    }

}
