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
//        if (\Yii::$app->user->isGuest) {
//        $token = \Yii::$app->session->get("orderToken");
        $cookies = Yii::$app->request->cookies;
        if (isset($cookies['orderToken'])) {
            $token = $cookies['orderToken']->value;
            $order = \common\models\costfit\Order::find()->where("token ='" . $token . "' AND status = " . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
        }
//        } else {
//            $order = \common\models\costfit\Order::find()->where("userId =" . \Yii::$app->user->id . " AND status = " . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
//        }
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
                    'qty' => $item->quantity,
                    'price' => $item->price,
                    'image' => isset($item->product->productImages[0]) ? \Yii::$app->homeUrl . $item->product->productImages[0]->image : $directoryAsset . "/img/catalog/shopping-cart-thumb.jpg",
                ];
            }
            $res["total"] = $total;
            $res["totalFormatText"] = number_format($total, 2);
            $res["shipping"] = $shipping;
            $res["shippingFormatText"] = number_format($shipping, 2);
            $res["summary"] = $total + $shipping;
            $res["summaryFormatText"] = number_format($total + $shipping, 2);
            $res["items"] = $items;
            $res["qty"] = $quantity;
        } else {
            $res = [
                'total' => $total,
                'totalFormatText' => number_format($total, 2),
                'shipping' => $shipping,
                'shippingFormatText' => number_format($shipping, 2),
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

}
