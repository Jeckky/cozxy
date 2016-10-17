<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderMaster;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "order".
 *
 * @property string $orderId
 * @property string $userId
 * @property string $token
 * @property string $orderNo
 * @property string $invoiceNo
 * @property string $summary
 * @property string $sendDate
 * @property string $billingCompany
 * @property string $billingTax
 * @property string $billingAddress
 * @property string $billingCountryId
 * @property string $billingProvinceId
 * @property string $billingAmphurId
 * @property string $billingZipcode
 * @property string $billingTel
 * @property string $shippingCompany
 * @property string $shippingTax
 * @property string $shippingAddress
 * @property string $shippingCountryId
 * @property string $shippingProvinceId
 * @property string $shippingAmphurId
 * @property string $shippingZipcode
 * @property string $shippingTel
 * @property integer $paymentType
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property User $user
 * @property StoreProductOrderItem[] $storeProductOrderItems
 */
class Order extends \common\models\costfit\master\OrderMaster {

    const ORDER_STATUS_DRAFT = 0;
    const ORDER_STATUS_REGISTER_USER = 1;
    const ORDER_STATUS_CHECKOUTS = 2;
    const ORDER_STATUS_E_PAYMENT_DRAFT = 3;
    const ORDER_STATUS_COMFIRM_PAYMENT = 4;
    const ORDER_STATUS_E_PAYMENT_SUCCESS = 5;
    const ORDER_STATUS_E_PAYMENT_PENDING = 6;
    const ORDER_STATUS_FINANCE_APPROVE = 7;
    const ORDER_STATUS_FINANCE_REJECT = 8;
    const ORDER_STATUS_SHIPPING = 9;
    const ORDER_STATUS_SHIPPED = 10;
    const ORDER_STATUS_PICKING = 11;
    const ORDER_STATUS_PICKED = 12;
    const ORDER_STATUS_PACKED = 13;
    const ORDER_STATUS_SENDING_SHIPPING = 14;
//
    const CHECKOUT_STEP_WAIT_CHECKOUT = 0;
    const CHECKOUT_STEP_ADDRESS = 1;
    const CHECKOUT_STEP_PAYMENT = 2;
    const CHECKOUT_STEP_SUCCESS = 3;
    const ORDER_STATUS_RECEIVED = 16;
    const ORDER_STATUS_SEND = 15;

    public $orderMessage = null;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'month',
            'maxCode',
            'orderItemId',
            'orderId',
            'bagNo',
            'status',
            'pickingId',
            'itemStatus',
            'fromDate',
            'toDate',
            'sumPicking',
            'sumSummary'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'paymentDateTime' => 'วันที่ชำระเงิน',
            'status' => 'สถานะ',
            'updateDateTime' => 'วันที่แก้ไข',
            'summary' => 'ยอดรวม',
            'userId' => 'ผู้ใช้งาน',
            'countItem' => 'จำนวนสินค้า'
        ]);
    }

    public static function findCartArray() {
        $res = [];
        $order = Order::getOrder();
        $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
        $total = 0;
        $totalWithoutDiacount = 0;
        $totalItemDiscount = 0;
        $quantity = 0;
        $shipping = 0;
        $items = [];
        if (isset($order)) {
            foreach ($order->orderItems as $item) {
                $total+=$item->total;
                $quantity+=$item->quantity;
                $totalWithoutDiacount +=$item->quantity * $item->priceOnePiece;
                $productPrice = ProductPrice::find()->where("productId = $item->productId AND quantity = $item->quantity")->one();
                $totalItemDiscount+=$productPrice->discountValue;
                $items[$item->orderItemId] = [
                    'orderItemId' => $item->orderItemId,
                    'productId' => $item->productId,
                    'title' => $item->product->title,
                    'code' => $item->product->code,
                    'qty' => $item->quantity,
                    'price' => $item->price,
                    'priceOnePiece' => $item->priceOnePiece,
                    'sendDate' => $item->sendDate,
                    'sendDateNoDate' => isset($item->shippingType) ? $item->shippingType->date : NULL,
                    'total' => $item->total,
                    'image' => isset($item->product->productImages[0]) ? \Yii::$app->homeUrl . $item->product->productImages[0]->image : $directoryAsset . "/img/catalog/shopping-cart-thumb.jpg",
                ];
            }
            $order->save(); // For Update Total;
            $res['orderId'] = $order->orderId;
            $res["totalExVat"] = $order->totalExVat;
            $res["totalExVatFormatText"] = number_format($order->totalExVat, 2);
            $res["vat"] = $order->vat;
            $res["vatFormatText"] = number_format($order->vat, 2);
            $res["total"] = $order->total;
            $res["totalWithoutDiscount"] = $totalWithoutDiacount;
            $res["totalWithoutDiscountText"] = number_format($totalWithoutDiacount, 2);
            $res["totalItemDiscount"] = $totalItemDiscount;
            $res["totalItemDiscountText"] = number_format($totalItemDiscount, 2);
            $res["totalFormatText"] = number_format($order->total, 2);

            if (isset($order->coupon)) {
                if (Coupon::getCouponIsExpired($order->couponId)) {
                    $order->orderMessage = "Coupon " . $order->coupon->code . " is expired.";
                    $order->couponId = NULL;
                    $order->save();
                    $res["couponCode"] = NULL;
                } else {
                    $res["couponCode"] = $order->coupon->code;
                }
            } else {
                $res["couponCode"] = NULL;
            }
            $res["discount"] = $order->discount;
            $res["discountFormatText"] = number_format($order->discount, 2);
            $res["shippingRate"] = $order->shippingRate;
            $res["shippingRateFormatText"] = number_format($order->shippingRate, 2);
            $res["summary"] = $order->summary;
            $res["summaryFormatText"] = number_format($order->summary, 2);
            $res["items"] = $items;
            $res["qty"] = $quantity;
            if (isset($order->orderMessage)) {
                $res["orderMessage"] = $order->orderMessage;
            }
        } else {
            $res = [
                'total' => $total,
                'totalFormatText' => number_format($total, 2),
                'shippingRate' => $shipping,
                'shippingRateFormatText' => number_format($shipping, 2),
                'summary' => $total + $shipping,
                'summaryFormatText' => number_format($total + $shipping, 2),
                'qty' => $quantity,
                'items' => [
//                    [
//                        'productId' => 0,
//                        'title' => '-- No Item Found --',
//                        'qty' => 0,
//                        'price' => 0,
//                    ],
//                    [
//                        'title' => 'Product 2',
//                        'qty' => 6,
//                        'price' => 11234,
//                    ],
//                    [
//                        'title' => 'Product 3',
//                        'qty' => 4,
//                        'price' => 12234,
//                    ],
//                    [
//                        'title' => 'Product 4',
//                        'qty' => 2,
//                        'price' => 51234,
//                    ],
                ]
            ];
        }
//        throw new \yii\base\Exception(print_r($res, true));
        return $res;
    }

    public function getCoupon() {
        return $this->hasOne(Coupon::className(), ['couponId' => 'couponId']);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        $total = 0;
        foreach ($this->orderItems as $item) {
            $total+=$item->total;
        }
        $this->totalExVat = $total * 0.93;
        $this->vat = ($total) * 0.07;
        $this->total = $total;
        $this->discount = null;
        if (isset($this->coupon) && isset($this->couponId)) {
            if (isset($this->coupon->orderSummaryTotal) && $total >= $this->coupon->orderSummaryTotal) {

            } else {
                if (isset($this->coupon->discountValue)) {
                    $this->discount = $this->coupon->discountValue;
                } else {
                    $this->discount = $this->total * ($this->coupon->discountPercent / 100);
                }
            }
        }
        $this->grandTotal = $this->total - $this->discount;
        $this->shippingRate = $this->calculateShippingRate();
        $this->summary = $this->grandTotal + $this->calculateShippingRate();
        return TRUE;
    }

    public static function calculateShippingRate() {
        return 0;
    }

    public function findCheckoutStepArray() {
        return [
            self::CHECKOUT_STEP_WAIT_CHECKOUT => "รอ Checkout",
            self::CHECKOUT_STEP_ADDRESS => "ระบุที่อยู่",
            self::CHECKOUT_STEP_PAYMENT => "เลือกช่องทางการชำระเงิน",
            self::CHECKOUT_STEP_SUCCESS => "Check สำเร็จ",
        ];
    }

    public function getCheckoutStepText($step) {
        $res = $this->findCheckoutStepArray();
        if (isset($res[$step])) {
            return $res[$step];
        } else {
            return NULL;
        }
    }

    public static function mergeDraftOrder() {

        $cookies = Yii::$app->request->cookies;
        if (isset($cookies['orderToken'])) {
            $token = $cookies['orderToken']->value;
            $orderToken = \common\models\costfit\Order::find()->where("token ='" . $token . "' AND userId is null  AND status = " . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
        }
        $orderUser = \common\models\costfit\Order::find()->where("userId =" . \Yii::$app->user->id . " AND status = " . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
//        throw new \yii\base\Exception(print_r($orderUser->attributes, true));
        $flag = true;
        try {
//            throw new \yii\base\Exception(count($orderToken->orderItems) . " " . count($orderUser->orderItems));
            $transaction = \Yii::$app->db->beginTransaction();
            if (isset($orderToken)) {
                if (isset($orderUser)) {
                    foreach ($orderToken->orderItems as $item) {
                        $haveItem = FALSE;
                        foreach ($orderUser->orderItems as $itemUser) {
                            if ($item->productId == $itemUser->productId) {
                                if ($item->updateDateTime > $itemUser->updateDateTime) {
                                    $itemUser->quantity = $item->quantity;
                                } else {
                                    $itemUser->quantity = $itemUser->quantity;
                                }
                                $itemUser->save();
                                $haveItem = TRUE;
                            }
                        }

//                        throw new \yii\base\Exception($haveItem);


                        if (!$haveItem) {
                            $orderItem = new OrderItem();
                            $orderItem->attributes = $item->attributes;
                            $orderItem->orderId = $orderUser->orderId;
                            if (!$orderItem->save()) {
                                $flag = FALSE;
                                throw new Exception("Can't Save Order User Item");
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $orderUser->token = $cookies['orderToken']->value;
                        $orderUser->save();
                        if (OrderItem::deleteAll("orderId=" . $orderToken->orderId) > 0) {
                            if (Order::deleteAll("orderId=" . $orderToken->orderId) == 0) {
                                $flag = FALSE;
                            }
                        } else {
                            $flag = FALSE;
                        }
                    }
                } else {
                    $orderToken->userId = \Yii::$app->user->id;
                    if (!$orderToken->save()) {
                        $flag = FALSE;
                    }
                }
            }
            if ($flag) {
                $transaction->commit();
            }
        } catch (Exception $exc) {
            $transaction->rollBack();
            echo $exc->getTraceAsString();
        }
    }

    public static function getOrder() {
        if (\Yii::$app->user->isGuest) {
            $cookies = Yii::$app->request->cookies;
            if (isset($cookies['orderToken'])) {
                $token = $cookies['orderToken']->value;
//                throw new \yii\base\Exception($token);
                return \common\models\costfit\Order::find()->where("token ='" . $token . "' AND userId is null  AND status = " . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
            }
        } else {
            return \common\models\costfit\Order::find()->where("userId =" . \Yii::$app->user->id . " AND status = " . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
        }
    }

    public static function findAllYearCirculationWithYear($year) {
        $res = [];
        $orders = Order::find()->select('sum(summary) as summary , month(paymentDateTime) as month')->where('year(paymentDateTime) =' . $year . " AND status >2")->groupBy('month(paymentDateTime)')->all();

        for ($i = 1; $i <= 12; $i++) {
            if (isset($orders[$i - 1]->month)) {
                $res[$i] = $orders[$i - 1]->summary;
            } else {
                $res[$i] = 0;
            }
        }
        return $res;
    }

    public static function genInvNo($model) {
//      $prefix = "IV" . UserCompany::model()->getPrefixBySupplierId($model->supplierId);
        $prefix = "IV";
        $max_code = intval(\common\models\costfit\Order::findMaxInvoiceNo($prefix));
        $max_code += 1;
        return $prefix . date("Ym") . str_pad($max_code, 7, "0", STR_PAD_LEFT);
    }

    public static function genOrderNo($supplierId = null) {
        $prefix = 'OD'; //$supplierModel->prefix;

        $max_code = intval(\common\models\costfit\Order::findMaxOrderNo($prefix));
        $max_code += 1;
        return $prefix . date("Ym") . "-" . str_pad($max_code, 7, "0", STR_PAD_LEFT);
    }

    public static function findMaxOrderNo($prefix = NULL) {
        $order = Order::findBySql("SELECT MAX(RIGHT(orderNo,7)) as maxCode from `order` WHERE substr(orderNo,1,2)='$prefix' order by orderNo DESC ")->one();
//        $order = Order::find()->select("MAX(RIGHT(orderNo,7)) as maxCode")
//        ->where("substr(orderNo,1,2)='$prefix' ")
//        ->orderBy('orderNo DESC ')
//        ->max("maxCode");
//        ->one();

        return isset($order) ? $order->maxCode : 0;
    }

    public static function findMaxInvoiceNo($prefix = NULL) {
// Warning: Please modify the following code to remove attributes that
// should not be searched.

        $order = Order::findBySql("SELECT MAX(RIGHT(invoiceNo,7)) as maxCode from `order` WHERE substr(invoiceNo,1,2)='$prefix' order by invoiceNo DESC ")->one();
        return isset($order) ? $order->maxCode : 0;
    }

    public function findAllStatusArray() {
        return [
            self::ORDER_STATUS_DRAFT => "ตระกร้าสินค้า",
            self::ORDER_STATUS_REGISTER_USER => "ลงทะเบียนผู้ใช้แล้ว",
            self::ORDER_STATUS_CHECKOUTS => 'รอการชำระเงิน',
            self::ORDER_STATUS_E_PAYMENT_DRAFT => 'ชำระบัตรเครดิตไม่สำเร็จ',
            self::ORDER_STATUS_COMFIRM_PAYMENT => 'ยืนยันชำระเงิน',
            self::ORDER_STATUS_E_PAYMENT_SUCCESS => 'ชำระบัตรเครดิตสำเร็จ',
            self::ORDER_STATUS_E_PAYMENT_PENDING => 'รอการตรวจสอบจากธนาคาร',
            self::ORDER_STATUS_FINANCE_APPROVE => 'การเงินตรวจสอบแล้ว',
            self::ORDER_STATUS_FINANCE_REJECT => 'การเงินส่งกลับ',
            self::ORDER_STATUS_SHIPPING => 'กำลังจัดส่ง',
            self::ORDER_STATUS_SHIPPED => 'จัดส่งแล้ว',
            self::ORDER_STATUS_PICKING => 'กำลังหยิบ',
            self::ORDER_STATUS_PICKED => 'หยิบแล้ว เตรียมแพ็ค',
            self::ORDER_STATUS_PACKED => 'ใส่ถุงแล้ว',
            self::ORDER_STATUS_RECEIVED => 'ลูกค้ารับสินค้าเรียบร้อยแล้ว',
            self::ORDER_STATUS_SEND => 'สามารถรับสินค้าได้'
        ];
    }

    public function getStatusText($status) {
        $res = $this->findAllStatusArray($status);
        if (isset($res[$status])) {
            return $res[$status];
        } else {
            return NULL;
        }
    }

    public static function findAllTodayOrder() {
        $res = [];
        $res["all"] = 0;
        $res["checkout"] = 0;
        $res["shipping"] = 0;
        $res["shipped"] = 0;
        $orders = Order::find()->where('date(updateDateTime) = curdate() ')->all();
        foreach ($orders as $order) {
            $res["all"] ++;
            switch ($order->status) {
                case Order::ORDER_STATUS_CHECKOUTS:
                    $res["checkout"] ++;
                    break;
                case Order::ORDER_STATUS_COMFIRM_PAYMENT:
                    $res["checkout"] ++;
                    break;
                case Order::ORDER_STATUS_E_PAYMENT_SUCCESS:
                    $res["checkout"] ++;
                    break;
                case Order::ORDER_STATUS_SHIPPING:
                    $res["shipping"] ++;
                    break;
                case Order::ORDER_STATUS_SHIPPED:
                    $res["shipped"] ++;
                    break;
            }
        }

        return $res;
    }

    public function search($params) {

        $query = \common\models\costfit\Order::find()->where("userId ='" . Yii::$app->user->id . "' and status > " . Order::ORDER_STATUS_REGISTER_USER . " and orderNo  is not null order by orderId desc");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        // load the search form data and validate
        if (!($this->load($params) )) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'createDateTime', $this->createDateTime])
                ->andFilterWhere(['like', 'orderNo', $this->orderNo]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems() {
        return $this->hasMany(OrderItem::className(), ['orderId' => 'orderId']); //[Order :: ปลายทาง ,  OrderItem :: ต้นทาง]
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    public function getAddress() {
        return $this->hasOne(address::className(), ['addressId' => 'addressId']);
    }

    public function getBillingProvince() {
        return $this->hasOne(\common\models\dbworld\States::className(), ['stateId' => 'billingProvinceId']);
    }

    public function getBillingCities() {
        return $this->hasOne(\common\models\dbworld\Cities::className(), ['cityId' => 'billingAmphurId']);
    }

    public function getbillingDistrict() {
        return $this->hasOne(\common\models\dbworld\District::className(), ['cityId' => 'billingAmphurId']);
    }

    public function getBillingCountry() {
        return $this->hasOne(\common\models\dbworld\Countries::className(), ['countryId' => 'billingCountryId']);
    }

    public function getShippingProvince() {
        return $this->hasOne(\common\models\dbworld\States::className(), ['stateId' => 'shippingProvinceId']);
    }

    public function getShippingCities() {
        return $this->hasOne(\common\models\dbworld\Cities::className(), ['cityId' => 'shippingAmphurId']);
    }

    public function getShippingDistrict() {
        return $this->hasOne(\common\models\dbworld\District::className(), ['cityId' => 'shippingAmphurId']);
    }

    public function getShippingCountry() {
        return $this->hasOne(\common\models\dbworld\Countries::className(), ['countryId' => 'shippingCountryId']);
    }

    public static function saveOrderPaymentHistory($order, $decision, $reasonCode, $userIp) {
        $history = new OrderPaymentHistory();
        $history->orderId = $order->orderId;
        $history->decision = $decision;
        $history->reasonCode = $reasonCode;
        $history->userIp = $userIp;
        $history->reason = EPayment::getReasonCodeText($reasonCode);
        $history->createDateTime = new \yii\db\Expression('NOW()');
        if ($history->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function findSlowestDate($orderId) {

    }

    public static function getItems($orderId) {
        //throw new \yii\base\Exception($orderId);
        $item = OrderItem::find()->where("orderId=" . $orderId)->all();
        if (isset($item)) {
            return $item;
        } else {
            return '';
        }
    }

    static public function findOrderNo($orderId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (isset($order)) {
            return $order->orderNo;
        } else {
            return '';
        }
    }

    static public function findOrderId($orderId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (isset($order)) {
            return $order->orderId;
        } else {
            return '';
        }
    }

    static public function findReciever($orderId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (isset($order)) {
            $user = User::find()->where("userId=" . $order->userId)->one();
            if (isset($user)) {
                return $user->firstname . " " . $user->lastname;
            } else {
                return 'ไม่พบข้อมูลผู้รับ';
            }
        } else {
            return '';
        }
    }

    public function getPickingpoint() {
        return $this->hasOne(\common\models\costfit\PickingPoint::className(), ['pickingId' => 'pickingId']);
    }

    public function getPickingpointitems() {
        return $this->hasOne(\common\models\costfit\PickingPointItems::className(), ['pickingId' => 'pickingId']);
    }

    public function getShipOrderItems($orderItemId) {
        return $this->hasMany(OrderItemPacking::className(), ['orderItemId' => 'orderItemId']);
    }

    static public function CountOrderItems($orderId) {
        $result = OrderItem::find()->where("orderId=" . $orderId . " and (status=13 or status=14)")->count();
        return $result;
    }

}
