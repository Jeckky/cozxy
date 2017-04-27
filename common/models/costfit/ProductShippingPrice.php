<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductShippingPriceMaster;

/**

 * This is the model class for table "product_shipping_price".
 *
 * @property integer $producetShippingPriceId
 * @property integer $productId
 * @property integer $shippingTypeId
 * @property string $discount
 * @property string $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductShippingPrice extends \common\models\costfit\master\ProductShippingPriceMaster {

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
        return array_merge(parent::attributeLabels(), [
            'shippingTypeId' => 'Shipping Type',
        ]);
    }

    public function getProduct() {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    public function getShippingType() {
        return $this->hasOne(ShippingType::className(), ['shippingTypeId' => 'shippingTypeId']);
    }

    public function getTypes() {
        $type = '';
        if (isset($this->type)) {
            if ($this->type == 1) {
                $type = 'CASH';
            } else {
                $type = '%';
            }
        }
        return $type;
    }

    public static function calProductShippingPrice($productId, $fastId = NULL, $orderItemId = NULL) {
        $res = [];
        $cart = Order::findCartArray();
        //throw new \yii\base\Exception($productId);
        $shippingTypeId = 0;
        if (!isset($fastId)) {
            if (isset($cart) && $cart['isSlowest'] == 1) {
                foreach ($cart["items"] as $item) {
                    if ($item["productId"] == $productId) {
                        $shippingTypeId = $item["sendDate"];
                        break;
                    }
                }
            } else {
                if (isset($orderItemId)) {
                    foreach ($cart["items"] as $item) {
                        if ($item["productId"] == $productId && $item["orderItemId"] == $orderItemId) {
                            $shippingTypeId = $item["firstTimeSendDate"];
                            break;
                        }
                    }
                } else {
                    foreach ($cart["items"] as $item) {
                        if ($item["productId"] == $productId) {
                            $shippingTypeId = $item["sendDate"];
                            break;
                        }
                    }
                }

//                if ($orderItemId == 476) {
//                    throw new \yii\base\Exception($shippingTypeId);
//                }
            }
        } else {
//            throw new \yii\base\Exception;
            $shippingTypeId = $fastId;
        }
        $shippingTypeIds = isset($shippingTypeId) ? $shippingTypeId : '';
        if ($shippingTypeIds != '') {
            $shippingDisCount = ProductShippingPrice::find()->where("productId=" . $productId . " AND shippingTypeId = " . $shippingTypeId)->one();
        } else {
            $shippingDisCount = ProductShippingPrice::find()->where("productId=" . $productId . " AND shippingTypeId ='' ")->one();
        }

        //throw new \yii\base\Exception($productId . " " . $shippingTypeId);
        if (isset($cart) && $cart['isSlowest'] == 0) {//
            if (isset($shippingDisCount)) {
                $res["type"] = $shippingDisCount->type;
                $res["discount"] = $shippingDisCount->discount;
            } else {
                $shippingDisCount = ProductShippingPrice::find()->where("productId=" . $productId)->orderBy("date DESC")->one();
                if (isset($shippingDisCount) && !empty($shippingDisCount)) {
                    $res["type"] = $shippingDisCount->type;
                    $res["discount"] = $shippingDisCount->discount;
                } else {
                    $res["type"] = 1;
                    $res["discount"] = 0;
                }
            }
        } else {
            $shippingDisCount = ProductShippingPrice::find()->where("productId=" . $productId)->orderBy("date DESC")->one();
            //$res["type"] = $shippingDisCount->type;
            //$res["discount"] = $shippingDisCount->discount;
            if (isset($shippingDisCount) && !empty($shippingDisCount)) {
                $res["type"] = $shippingDisCount->type;
                $res["discount"] = $shippingDisCount->discount;
            } else {
                $res["type"] = 1;
                $res["discount"] = 0;
            }
        }
        //throw new \yii\base\Exception(print_r($res, true));
        return $res;
    }

}
