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
class Order extends \common\models\costfit\master\OrderMaster
{

    const ORDER_STATUS_DRAFT = 0;
    const ORDER_STATUS_REGISTER_USER = 1;
    const ORDER_STATUS_CHECKOUTS = 2;
    const ORDER_STATUS_E_PAYMENT_DRAFT = 3;
    const ORDER_STATUS_COMFIRM_PAYMENT = 4;
    const ORDER_STATUS_E_PAYMENT_SUCCESS = 5;
    const ORDER_STATUS_FINANCE_APPROVE = 6;
    const ORDER_STATUS_FINANCE_REJECT = 7;
    const ORDER_STATUS_SHIPPING = 8;
    const ORDER_STATUS_SHIPPED = 9;
//
    const CHECKOUT_STEP_WAIT_CHECKOUT = 0;
    const CHECKOUT_STEP_ADDRESS = 1;
    const CHECKOUT_STEP_PAYMENT = 2;
    const CHECKOUT_STEP_SUCCESS = 3;

    public $orderMessage = null;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'month',
            'maxCode'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'paymentDateTime' => 'วันที่ชำระเงิน',
            'status' => 'สถานะ',
            'updateDateTime' => 'วันที่แก้ไข',
            'summary' => 'ยอดรวม',
            'userId' => 'ผู้ใช้งาน',
            'countItem' => 'จำนวนสินค้า'
        ]);
    }

    public static function findCartArray()
    {
        $res = [];
        $order = Order::getOrder();
        $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
        $total = 0;
        $quantity = 0;
        $shipping = 0;
        $items = [];
        if (isset($order)) {
            foreach ($order->orderItems as $item) {

                $total+=$item->total;
                $quantity+=$item->quantity;
                $items[$item->orderItemId] = [
                    'orderItemId' => $item->orderItemId,
                    'productId' => $item->productId,
                    'title' => $item->product->title,
                    'code' => $item->product->code,
                    'qty' => $item->quantity,
                    'price' => $item->price,
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
        return $res;
    }

    public function getCoupon()
    {
        return $this->hasOne(Coupon::className(), ['couponId' => 'couponId']);
    }

    public function beforeSave($insert)
    {
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

    public static function calculateShippingRate()
    {
        return 0;
    }

    public function findCheckoutStepArray()
    {
        return [
            self::CHECKOUT_STEP_WAIT_CHECKOUT => "รอ Checkout",
            self::CHECKOUT_STEP_ADDRESS => "ระบุที่อยู่",
            self::CHECKOUT_STEP_PAYMENT => "เลือกช่องทางการชำระเงิน",
            self::CHECKOUT_STEP_SUCCESS => "Check สำเร็จ",
        ];
    }

    public function getCheckoutStepText($step)
    {
        $res = $this->findCheckoutStepArray();
        if (isset($res[$step])) {
            return $res[$step];
        } else {
            return NULL;
        }
    }

    public static function mergeDraftOrder()
    {

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

    public static function getOrder()
    {
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

    public static function findAllYearCirculationWithYear($year)
    {
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

    public static function genInvNo($model)
    {
//      $prefix = "IV" . UserCompany::model()->getPrefixBySupplierId($model->supplierId);
        $prefix = "IV";
        $max_code = $this->findMaxInvoiceNo($model);
        $max_code += 1;
        return $prefix . date("Ym") . str_pad($max_code, 7, "0", STR_PAD_LEFT);
    }

    public static function genOrderNo($supplierId = null)
    {
        $prefix = 'OD'; //$supplierModel->prefix;

        $max_code = intval(\common\models\costfit\Order::findMaxOrderNo($prefix));
        $max_code += 1;
        return $prefix . date("Ym") . "-" . str_pad($max_code, 7, "0", STR_PAD_LEFT);
    }

    public static function findMaxOrderNo($prefix = NULL)
    {
        $order = Order::findBySql("SELECT MAX(RIGHT(orderNo,7)) as maxCode from `order` WHERE substr(orderNo,1,2)='$prefix' order by orderNo DESC ")->one();
//        $order = Order::find()->select("MAX(RIGHT(orderNo,7)) as maxCode")
//        ->where("substr(orderNo,1,2)='$prefix' ")
//        ->orderBy('orderNo DESC ')
//        ->max("maxCode");
//        ->one();

        return isset($order) ? $order->maxCode : 0;
    }

    public static function findMaxInvoiceNo($model)
    {
// Warning: Please modify the following code to remove attributes that
// should not be searched.
        $supplierUser = Supplier::model()->findByPk($model->supplierId);

        $criteria = new CDbCriteria;

        $criteria->select = 'max(RIGHT(invoiceNo,6)) as maxCode';
//		if(isset($supplierUser->redirectURL))
//		{
        if ($supplierUser->supplierId == 1 || $supplierUser->supplierId == 3) {
            $criteria->condition = 'YEAR(updateDateTime) = YEAR(NOW()) AND (supplierId = 1 OR supplierId = 3) AND paymentMethod = ' . $model->paymentMethod;
        } else if ($supplierUser->supplierId == 4 || $supplierUser->supplierId == 5) {
            $criteria->condition = 'YEAR(updateDateTime) = YEAR(NOW()) AND (supplierId = 4 OR supplierId = 5) AND paymentMethod = ' . $model->paymentMethod;
        } else {
            $criteria->condition = 'YEAR(updateDateTime) = YEAR(NOW()) AND supplierId = ' . $supplierUser->supplierId . ' AND paymentMethod = ' . $model->paymentMethod;
        }
//		}
//		else
//		{
//			$supplierArray = array();
//			$supplierArray = User::model()->findAllSupplierHasRedirectURL();
//			$criteria->condition = 'MONTH(updateDateTime) = MONTH(NOW())';
//		$criteria->addNotInCondition('supplierId', $supplierArray);
//		}
        $result = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
        return isset($result->data[0]) ? $result->data[0]->maxCode : 0;
    }

    public function findAllStatusArray()
    {
        return [
            self::ORDER_STATUS_DRAFT => "ตระกร้าสินค้า",
            self::ORDER_STATUS_REGISTER_USER => "ลงทะเบียนผู้ใช้แล้ว",
            self::ORDER_STATUS_CHECKOUTS => 'รอการชำระเงิน',
            self::ORDER_STATUS_E_PAYMENT_DRAFT => 'ชำระบัตรเครดิตไม่สำเร็จ',
            self::ORDER_STATUS_COMFIRM_PAYMENT => 'ยืนยันชำระเงิน',
            self::ORDER_STATUS_E_PAYMENT_SUCCESS => 'ชำระบัตรเครดิตสำเร็จ',
            self::ORDER_STATUS_FINANCE_APPROVE => 'การเงินตรวจสอบแล้ว',
            self::ORDER_STATUS_FINANCE_REJECT => 'การเงินส่งกลับ',
            self::ORDER_STATUS_SHIPPING => 'กำลังจัดส่ง',
            self::ORDER_STATUS_SHIPPED => 'จัดส่งแล้ว',
        ];
    }

    public function getStatusText($status)
    {
        $res = $this->findAllStatusArray($status);
        if (isset($res[$status])) {
            return $res[$status];
        } else {
            return NULL;
        }
    }

    public static function findAllTodayOrder()
    {
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

    public function search($params)
    {

        $query = \common\models\costfit\Order::find()->where("userId ='" . Yii::$app->user->id . "' and status = 2 and orderNo  is not null");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['orderId' => 'orderId']); //[Order :: ปลายทาง ,  OrderItem :: ต้นทาง]
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    public function getAddress()
    {
        return $this->hasOne(address::className(), ['addressId' => 'addressId']);
    }

    public function getBillingProvince()
    {
        return $this->hasOne(\common\models\dbworld\States::className(), ['stateId' => 'billingProvinceId']);
    }

    public function getBillingCities()
    {
        return $this->hasOne(\common\models\dbworld\Cities::className(), ['cityId' => 'billingAmphurId']);
    }

    public function getbillingDistrict()
    {
        return $this->hasOne(\common\models\dbworld\District::className(), ['cityId' => 'billingAmphurId']);
    }

    public function getBillingCountry()
    {
        return $this->hasOne(\common\models\dbworld\Countries::className(), ['countryId' => 'billingCountryId']);
    }

    public function getShippingProvince()
    {
        return $this->hasOne(\common\models\dbworld\States::className(), ['stateId' => 'shippingProvinceId']);
    }

    public function getShippingCities()
    {
        return $this->hasOne(\common\models\dbworld\Cities::className(), ['cityId' => 'shippingAmphurId']);
    }

    public function getShippingDistrict()
    {
        return $this->hasOne(\common\models\dbworld\District::className(), ['cityId' => 'shippingAmphurId']);
    }

    public function getShippingCountry()
    {
        return $this->hasOne(\common\models\dbworld\Countries::className(), ['countryId' => 'shippingCountryId']);
    }

}
