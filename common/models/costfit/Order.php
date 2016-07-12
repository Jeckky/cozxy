<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderMaster;

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
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
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
        $flag = true;
        try {
            $transaction = \Yii::$app->db->beginTransaction();
            if (isset($orderToken)) {
                if (isset($orderUser)) {
                    foreach ($orderToken->orderItems as $item) {
                        $haveItem = FALSE;
                        foreach ($orderUser->orderItems as $itemUser) {
                            if ($item->productId == $itemUser->productId)
                                if ($item->updateDateTime > $itemUser->updateDateTime) {
                                    $orderUser->quantity = $item->quantity;
                                } else {
                                    $orderUser->quantity = $itemUser->quantity;
                                }
                            $haveItem = TRUE;
                        }

                        if (!$haveItem) {
                            $orderItem = new OrderItem();
                            $orderItem->attributes = $item->attributes;
                            $orderItem->orderId = $itemUser->orderId;
                            if (!$orderItem->save()) {
                                $flag = FALSE;
                                break;
                            }
                        }
                    }
                    if ($flag) {
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
                return \common\models\costfit\Order::find()->where("token ='" . $token . "' AND userId is null  AND status = " . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
            }
        } else {
            return \common\models\costfit\Order::find()->where("userId =" . \Yii::$app->user->id . " AND status = " . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
        }
    }

}
