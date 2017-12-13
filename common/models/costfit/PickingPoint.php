<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PickingPointMaster;
use yii\helpers\ArrayHelper;

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
class PickingPoint extends \common\models\costfit\master\PickingPointMaster {

    const TYPE_PICKINGPOINT = 1; // point

    /**
     * @inheritdoc
     */

    public function rules() {
        return array_merge(parent::rules(), [
            //[['provinceId', 'amphurId', 'pickingId'], 'required'],
            [['provinceId', 'amphurId', 'type', 'isDefault'], 'required', 'on' => 'picking_point'],
            //[['pickingId', 'LcpickingId'], 'required', 'on' => self::COZXY_PICKING_POINT_SUMMARY],
            [['pickingId', 'LcpickingId'], 'required', 'on' => 'checkout_summary'],
            [['provinceId', 'amphurId', 'pickingId'], 'required', 'on' => 'picking_point_new'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getCitie() {
        return $this->hasOne(\common\models\dbworld\Cities::className(), ['cityId' => 'amphurId']);
    }

    public function getCountrie() {
        return $this->hasOne(\common\models\dbworld\Countries::className(), ['countryId' => 'countryId']);
    }

    public function getDistrict() {
        return $this->hasOne(\common\models\dbworld\District::className(), ['districtId' => 'districtId']);
    }

    public function getState() {
        return $this->hasOne(\common\models\dbworld\States::className(), ['stateId' => 'provinceId']);
    }

    static public function findPickingPoitItem($orderId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (isset($order)) {
            if ($order->pickingId != 0) {
                $pickingPoint = PickingPoint::find()->where("pickingId=" . $order->pickingId)->one();
                if (isset($pickingPoint)) {
                    return $pickingPoint->title;
                } else {
                    return 'ไม่พบจุดส่งสินค้า';
                }
            } else {
                $amphur = \common\models\dbworld\Cities::find()->where("cityId=" . $order->shippingAmphurId)->one();
                $district = \common\models\dbworld\District::find()->where("districtId=" . $order->shippingDistrictId)->one();
                $province = \common\models\dbworld\States::find()->where("stateId=" . $order->shippingProvinceId)->one();
                $zipCode = \common\models\dbworld\Zipcodes::find()->where("zipcodeId=" . $order->shippingZipcode)->one();
                $picking = $order->shippingAddress . " " . $district->districtName . " " . $amphur->cityName . " " . $province->stateName . " " . $zipCode->zipcode;
                return $picking;
            }
        } else {
            return 'ไม่พบรายการ Order';
        }
    }

    public function getPickingPointItems() {
        return $this->hasMany(\common\models\costfit\PickingPointItems::className(), ['pickingId' => 'pickingId']);
    }

    static function ordersending($orderNo, $boxcode) {
        if ($orderNo != '') {
            if (\Yii::$app->params['shippingScanTrayOnly'] == true) {
                /* shippingScanTrayOnly = true เข้าเงื่อนไขที่ 1 ต้อง Scan ทีละ OrderId */
                //$query = \common\models\costfit\OrderItemPacking::find()->where('status =4')->all();

                $queryList = \common\models\costfit\Order::find()->where("orderNo = '" . $orderNo . "' and pickingId = '" . $boxcode . "' ")->one();
                if (count($queryList) > 0) {
                    $queryItem = \common\models\costfit\OrderItem::find()->where("orderId=" . $queryList->orderId . ' and status =13')->all(); // status : 6 pack ใส่ลงถุง

                    foreach ($queryItem as $items) {
                        $orderItemPackings = OrderItemPacking::find()->where("orderItemId =" . $items->orderItemId . ' and status = ' . OrderItemPacking::ORDER_STATUS_CLOSE_BAG)->all(); // status 4 : ปิดถุงแล้ว
                        // echo '<pre>';
                        //throw new \yii\base\Exception(print_r($orderItemPackings, TRUE));
                        // exit();
                        if (isset($orderItemPackings)) {
                            foreach ($orderItemPackings as $packing) {
                                $packing->status = OrderItemPacking::ORDER_STATUS_SENDING_PACKING_SHIPPING; // 5
                                $packing->save(FALSE);
                                $queryItemStatus = \common\models\costfit\OrderItem::find()->where("orderItemId=" . $packing->orderItemId . ' and status = 13')->all();
                                foreach ($queryItemStatus as $shipStatus) {
                                    $shipStatus->status = \common\models\costfit\OrderItem::ORDER_STATUS_SENDING_SHIPPING; // orderItemId : status = 14
                                    $shipStatus->save();
                                    $queryList->status = \common\models\costfit\Order::ORDER_STATUS_SENDING_SHIPPING; // orderItemId : status = 14
                                    $queryList->save();
                                }
                                //\common\models\costfit\OrderItem::updateAll(['status' => \common\models\costfit\OrderItem::ORDER_STATUS_SENDING_SHIPPING], ['orderItemId' => $packing->orderItemId, 'status' => 6]);
                                //echo '<pre>';
                                //print_r($packing);
                            }
                        }
                    }
                }
                //throw new \yii\base\Exception(print_r($queryList, TRUE));
            } else {
                /* shippingScanTrayOnly = false เข้าเงื่อนไขที่ 2 ต้อง Scan ทีละถุง */
            }
        }
    }

    /**
     * @inheritdoc
     * receive ip address , array of portIndex , MacAddress if have
     * return bool open status
     */
    public static function openAllChannel($ip, $portIndexs, $macAddress = NULL) {
        // port
        return TRUE;
    }

    public static function openChannel($ip, $portIndex, $macAddress = NULL) {
        // port
        return TRUE;
    }

    public static function pickingPointName($pickingPointId) {
        $pickingPoint = PickingPoint::find()->where("pickingId=" . $pickingPointId)->one();
        if (isset($pickingPoint) && !empty($pickingPoint)) {
            return $pickingPoint->title;
        } else {
            return '';
        }
    }

    public static function provinceName($stateId) {
        $localName = '';
        $province = \common\models\dbworld\States::find()->where("stateId=" . $stateId["stateId"])->one();
        if (isset($province)) {
            $localName = $province->localName . " / " . $province->stateName;
        }
        return $localName;
    }

    public static function availableProvince() {
        preg_match("/dbname=([^;]*)/", Yii::$app->get("db")->dsn, $dbName);

        $available = \common\models\dbworld\States::find()->select(['states.stateId', 'states.localName', 'states.stateName'])
                        ->leftJoin($dbName[1] . '.picking_point cpp', 'states.stateId=cpp.provinceId')
                        ->where('cpp.status = 1')
                        ->groupBy('cpp.provinceId')
                        ->orderBy('states.localName')
                        ->asArray()->all();
        if (count($available) > 0) {
            return $available;
        } else {
            return NULL;
        }
    }

    public static function availableProvince_bk() {
        preg_match("/dbname=([^;]*)/", Yii::$app->get("db")->dsn, $dbName);

        $available = ArrayHelper::map(\common\models\dbworld\States::find()->select(['states.stateId', 'states.localName'])
                                ->leftJoin($dbName[1] . '.picking_point cpp', 'states.stateId=cpp.provinceId')
                                ->where('cpp.status = 1')
                                ->groupBy('cpp.provinceId')
                                ->orderBy('states.localName')
                                ->asArray()->all(), 'stateId', 'localName');

        return $available;
    }

}
