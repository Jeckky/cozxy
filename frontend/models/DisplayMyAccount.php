<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\costfit\Address;
use common\models\costfit\User;
use common\models\costfit\UserPoint;
use common\models\costfit\TopUp;
use common\models\costfit\Wishlist;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Order;

/**
 * ContactForm is the model behind the contact form.
 */
class DisplayMyAccount extends Model {

    public static function myAccountBillingAddress($status, $type) {
        $products = [];
        $dataAddress = Address::find()->where("userId ='" . Yii::$app->user->id . "' and type =" . $type)->orderBy('addressId DESC')->all();
        foreach ($dataAddress as $items) {
            $products[$items->addressId] = [
                'addressId' => $items->addressId,
                'userId' => $items->userId,
                'firstname' => $items->firstname,
                'lastname' => $items->lastname,
                'company' => $items->company,
                'tax' => $items->tax,
                'address' => isset($items->address) ? $items->address : '' . ' , ',
                'country' => isset($items->countries->localName) ? $items->countries->localName : '' . ' , ',
                'province' => isset($items->states->localName) ? $items->states->localName : '' . ' , ',
                'amphur' => isset($items->cities->localName) ? $items->cities->localName : '' . ' , ',
                'district' => isset($items->district->localName) ? $items->district->localName : '' . ' , ',
                'zipcode' => isset($items->zipcodes->zipcode) ? $items->zipcodes->zipcode : '' . ' , ',
                'tel' => $items->tel,
                'type' => $items->type,
                'isDefault' => $items->isDefault,
                'status' => $items->status,
                'createDateTime' => $items->createDateTime,
                'updateDateTime' => $items->updateDateTime,
                'email' => $items->email,
            ];
        }
        return $products;
    }

    public static function myAccountPersonalDetails($status, $type) {
        $products = [];
        $dataUser = User::find()->where("userId ='" . Yii::$app->user->id . "' ")->one();
        $products[$dataUser['userId']] = [
            'userId' => $dataUser['userId'],
            'firstname' => isset($dataUser['firstname']) ? $dataUser['firstname'] : '&nbsp;-&nbsp;',
            'lastname' => isset($dataUser['lastname']) ? $dataUser['lastname'] : '&nbsp;-&nbsp;',
            'email' => isset($dataUser['email']) ? $dataUser['email'] : '&nbsp;-&nbsp;',
            'birthDate' => isset($dataUser['birthDate']) ? $dataUser['birthDate'] : FALSE,
            'gender' => isset($dataUser['gender']) ? $dataUser['gender'] : '',
            'tel' => isset($dataUser['tel']) ? $dataUser['tel'] : '-',
        ];
        return $products;
    }

    public static function myAccountCozxyCoin($status, $type) {
        $products = [];
        $dataUserPoint = UserPoint::find()->where('userId=' . \Yii::$app->user->id)->one();
        $dataTopUp = TopUp::find()
        ->select('*')
        ->join("LEFT JOIN", "payment_method", "payment_method.paymentMethodId = top_up.paymentMethod")
        ->where('top_up.userId =' . \Yii::$app->user->id)->orderBy('top_up.updateDateTime desc')->one();
        $products[$dataUserPoint['userPointId']] = [
            'userPointId' => $dataUserPoint['userPointId'],
            'userId' => isset($dataUserPoint['userId']) ? $dataUserPoint['userId'] : '-',
            'currentPoint' => isset($dataUserPoint['currentPoint']) ? number_format($dataUserPoint['currentPoint'], 2) : '0',
            'currentCozxySystemPoint' => isset($dataUserPoint) ? $dataUserPoint->currentCozxySystemPoint : 0,
            'totalPoint' => isset($dataUserPoint['totalPoint']) ? number_format($dataUserPoint['totalPoint'], 2) : '0',
            'totalMoney' => isset($dataUserPoint['totalMoney']) ? number_format($dataUserPoint['totalMoney'], 2) : '0',
            'totalMoney' => isset($dataUserPoint['updateDateTime']) ? $dataUserPoint['updateDateTime'] : '-',
            'method' => isset($dataUserPoint['title']) ? $dataUserPoint['title'] : '-',
        ];
        return $products;
    }

    public static function myAccountWishList($shelfId, $limit) {
        $products = [];
        if ($limit == 0) {
            $dataWishlist = Wishlist::find()->where("userId = " . \Yii::$app->user->id . " and productShelfId=" . $shelfId)->orderBy('wishlistId DESC')
            ->all();
        } else {
            $dataWishlist = Wishlist::find()->where("userId = " . \Yii::$app->user->id . " and productShelfId=" . $shelfId)->orderBy('wishlistId DESC')
            ->limit($limit)
            ->all();
        }

        foreach ($dataWishlist as $items) {
            //$dataProductSuppliers = ProductSuppliers::find()->where('productSuppId=' . $items->productId)->all();
            $value = ProductSuppliers::find()
            ->select('`product_price_suppliers`.*,`product_suppliers`.*')
            ->join('LEFT JOIN', 'product_price_suppliers', 'product_suppliers.productSuppId=product_price_suppliers.productSuppId')
            ->where('product_suppliers.productId=' . $items->productId . ' and product_suppliers.result>0 and product_price_suppliers.price!=0')
            ->orderBy('product_price_suppliers.price DESC')
            ->one();
            if (isset($value)) {
                $maxQnty = $value['result'];
            } else {
                $value = \common\models\costfit\Product::find()->where("productId=" . $items->productId)->one();
                $maxQnty = 0;
            }
            $price_s = isset($value['price']) ? number_format($value['price'], 2) : '';
            $price = isset($value['price']) ? number_format($value['price'], 2) : '';
            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value['productId'], $value['productSuppId'], 'Svg260x260');

            if (Yii::$app->controller->id == 'my-account') {
                $title = isset($value['title']) ? substr($value['title'], 0, 35) : '';
            } else {
                $title = isset($value['title']) ? $value['title'] : '';
            }
            $products[$value['productSuppId']] = [
                'wishlistId' => $items->wishlistId,
                'productSuppId' => $value['productSuppId'],
                'image' => $productImagesThumbnail1,
                'brand' => isset($value['brand']) ? $value->brand->title : '',
                'url' => Yii::$app->homeUrl . 'product/' . ProductSuppliers::encodeParams(['productId' => $value['productId'], 'productSupplierId' => $value['productSuppId']]),
                'brand' => isset($value['brand']) ? $value->brand->title : '',
                'title' => $title,
                'price_s' => $price_s,
                'price' => $price,
                'maxQnty' => $maxQnty,
                'fastId' => FALSE,
                'productId' => $value['productId'],
                'supplierId' => $value['userId'],
                'receiveType' => $value['receiveType'],
            ];
            // }
        }
        return $products;
    }

    public static function wishlistItems($shelfId) {
        $products = [];
        $dataWishlist = Wishlist::find()->where("userId = " . \Yii::$app->user->id . " and productShelfId=" . $shelfId)->orderBy('wishlistId DESC')
        ->all();
        if (isset($dataWishlist) && count($dataWishlist) > 0) {
            return count($dataWishlist);
        } else {
            return 0;
        }
    }

    public static function myAccountOrderHistory($status, $type) {
        $products = [];
        $dataOrder = Order::find()
        ->where("userId ='" . Yii::$app->user->id . "' and status > " . Order::ORDER_STATUS_REGISTER_USER . "")->all();
        foreach ($dataOrder as $value) {
            if ($value->orderNo == NULL) {
                $orderNo = '-';
            } else {
                $orderNo = $value->orderNo;
            }
            $products[$value->orderId] = [
                'orderId' => $value->orderId,
                'orderNo' => $orderNo,
                'statusNum' => $value->status,
                'status' => $value->getStatusTextEn($value->status),
                'updateDateTime' => $value->updateDateTime,
                'action' => '',
            ];
        }
        return $products;
    }

    public static function myAccountOrderHistorySort($status, $orderNo) {
        $products = [];
        $whereArray = [];

        $whereArray["userId"] = Yii::$app->user->id;
        if ($orderNo != '') {
            $whereArray["order.orderNo"] = $orderNo;
        }

        if ($status == 'show1') { // Last 10 orders
            $dataOrder = Order::find()
            ->where($whereArray)
            ->andWhere(' status > ' . Order::ORDER_STATUS_REGISTER_USER)
            ->orderBy([
                'orderId' => SORT_DESC //Need this line to be fixed
            ])
            ->all();
        } else if ($status == 'show2') { // 15วันที่ผ่านมา
            $dataOrder = Order::find()
            //->where("userId ='" . Yii::$app->user->id . "' and status > " . Order::ORDER_STATUS_REGISTER_USER . " and orderNo= '" . $type . "' ")
            ->where($whereArray)
            ->andWhere(' status > ' . Order::ORDER_STATUS_REGISTER_USER . ' and order.createDateTime BETWEEN (NOW() - INTERVAL 15 DAY) AND NOW()')
            ->all();
        } else if ($status == 'show3') { // ระยะ 30 วันที่ผ่านมา
            $dataOrder = Order::find()
            //->where("userId ='" . Yii::$app->user->id . "' and status > " . Order::ORDER_STATUS_REGISTER_USER . " and orderNo= '" . $type . "' ")
            ->where($whereArray)
            ->andWhere(' status > ' . Order::ORDER_STATUS_REGISTER_USER . ' and order.createDateTime BETWEEN (NOW() - INTERVAL 30 DAY) AND NOW()')
            ->all();
        } else if ($status == 'show4') { // ระยะ 6 เดือนที่ผ่านมา
            // (NOW() - INTERVAL 1 MONTH) <= (NOW() )
            $dataOrder = Order::find()
            //->where("userId ='" . Yii::$app->user->id . "' and status > " . Order::ORDER_STATUS_REGISTER_USER)
            ->where($whereArray)
            ->andWhere(' status > ' . Order::ORDER_STATUS_REGISTER_USER . ' and (NOW() - INTERVAL 6 MONTH) <= NOW()')
            ->all();
        } else if ($status == 'show5') { // คำสั่งซื้อในปี 2017
            $dataOrder = Order::find()
            //->where("userId ='" . Yii::$app->user->id . "' and status > " . Order::ORDER_STATUS_REGISTER_USER . " and orderNo= '" . $type . "' ")
            ->where($whereArray)
            ->andWhere(' status > ' . Order::ORDER_STATUS_REGISTER_USER . ' and YEAR(order.createDateTime) <=  YEAR(order.createDateTime)')
            ->all();
        } else if ($status == 'show6') { // คำสั่งซื้อในปี 2016
            $dataOrder = Order::find()
            //->where("userId ='" . Yii::$app->user->id . "' and status > " . Order::ORDER_STATUS_REGISTER_USER . " and orderNo= '" . $type . "' ")
            ->where($whereArray)
            ->andWhere(' status > ' . Order::ORDER_STATUS_REGISTER_USER . ' and YEAR(order.createDateTime) <=  YEAR(order.createDateTime)-1  ')
            ->all();
        } else {
            $dataOrder = Order::find()
            ->where($whereArray)
            ->andWhere(' status > ' . Order::ORDER_STATUS_REGISTER_USER)
            //->where("userId ='" . Yii::$app->user->id . "' and status > " . Order::ORDER_STATUS_REGISTER_USER . "  and orderNo= '" . $type . "' ")
            ->all();
        }

        foreach ($dataOrder as $value) {
            if ($value->orderNo == NULL) {
                $orderNo = '-';
            } else {
                $orderNo = $value->orderNo;
            }
            $products[$value->orderId] = [
                'orderId' => $value->orderId,
                'orderNo' => $orderNo,
                'statusNum' => $value->status,
                'status' => $value->getStatusTextEn($value->status),
                'updateDateTime' => $value->updateDateTime,
                'action' => '',
            ];
        }
        return $products;
    }

    public static function myAccountEditPersonalDetail($data = array()) {
        $birthDate = $data['yyyy'] . '-' . $data['mm'] . '-' . $data['dd'] . ' 00:00:00';
        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        $model->attributes = $data;
        $model->firstname = $data['firstname'];
        $model->lastname = $data['lastname'];
        $model->gender = $data['gender'];
        $model->tel = $data['tel'];
        $model->birthDate = $birthDate;
        if ($model->save(FALSE)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function myAccountChangePassword($data = array()) {
        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        $model->password_hash = Yii::$app->security->generatePasswordHash($data['newPassword']);
        if ($model->save(FALSE)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function ForgetNewChangePassword($email, $token, $data = array()) {
        $model = \common\models\costfit\User::find()->where("email ='" . $email . "' and token = '" . $token . "' ")->one();
        //$model->password = $data['newPassword'];
        $model->password_hash = Yii::$app->security->generatePasswordHash($data['newPassword']);
        if ($model->save(FALSE)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function ConfirmRegisterBooth($otp, $token, $email) {
        if ($token != '') {
            $model = \common\models\costfit\User::find()->where("email ='" . $email . "' and token = '" . $token . "' and password ='" . $otp . "' ")->one();
        } else {
            $model = \common\models\costfit\User::find()->where("email ='" . $email . "'  and password ='" . $otp . "' ")->one();
        }

        if (isset($model)) {
            //$model->password = $data['newPassword'];
            $model->status = 1;
            if ($model->save(FALSE)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}
