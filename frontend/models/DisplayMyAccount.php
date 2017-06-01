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
                'country' => isset($items->countries->countryName) ? $items->countries->countryName : '' . ' , ',
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
            'birthDate' => isset($dataUser['birthDate']) ? $dataUser['birthDate'] : '&nbsp;-&nbsp;',
            'gender' => isset($dataUser['gender']) ? $dataUser['gender'] : '',
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
            'totalPoint' => isset($dataUserPoint['totalPoint']) ? number_format($dataUserPoint['totalPoint'], 2) : '0',
            'totalMoney' => isset($dataUserPoint['totalMoney']) ? number_format($dataUserPoint['totalMoney'], 2) : '0',
            'totalMoney' => isset($dataUserPoint['updateDateTime']) ? $dataUserPoint['updateDateTime'] : '-',
            'method' => isset($dataUserPoint['title']) ? $dataUserPoint['title'] : '-',
        ];
        return $products;
    }

    public static function myAccountWishList($status, $type) {
        $products = [];
        $dataWishlist = Wishlist::find()->where("userId = " . \Yii::$app->user->id)->orderBy('wishlistId DESC')->all();
        foreach ($dataWishlist as $items) {
            $dataProductSuppliers = ProductSuppliers::find()->where('productSuppId=' . $items->productId)->all();
            foreach ($dataProductSuppliers as $value) {
                $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('ordering asc')->one();
                $productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
                $price_s = number_format($value->price, 2);
                $price = number_format($value->price, 2);
                if (isset($productImages->imageThumbnail1) && !empty($productImages->imageThumbnail1)) {
                    if (file_exists(Yii::$app->basePath . "/web/" . $productImages->imageThumbnail1)) {
                        $productImagesThumbnail1 = '/' . $productImages->imageThumbnail1;
                    } else {
                        $productImagesThumbnail1 = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjYwIiBoZWlnaHQ9IjI2MCIgdmlld0JveD0iMCAwIDY0IDY0IiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48IS0tDQpTb3VyY2UgVVJMOiBob2xkZXIuanMvMjYweDI2MA0KQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4NCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQ0KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28NCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWMwYTg2ZjY1YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YzBhODZmNjVhIj48cmVjdCB3aWR0aD0iMjYwIiBoZWlnaHQ9IjI2MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjYuMjI2NTYyNSIgeT0iMzYuNTMyODEyNSI+MjYweDI2MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==';
                    }
                }
                if (Yii::$app->controller->id == 'my-account') {
                    $title = isset($value->title) ? substr($value->title, 0, 35) : '';
                } else {
                    $title = isset($value->title) ? $value->title : '';
                }
                $products[$value->productSuppId] = [
                    'wishlistId' => $items->wishlistId,
                    'productSuppId' => $value->productSuppId,
                    'image' => $productImagesThumbnail1,
                    'brand' => isset($value->brand) ? $value->brand->title : '',
                    'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                    'brand' => isset($value->brand) ? $value->brand->title : '',
                    'title' => $title,
                    'price_s' => $productPrice->price,
                    'price' => $productPrice->price,
                ];
            }
        }
        return $products;
    }

    public static function myAccountOrderHistory($status, $type) {
        $products = [];
        $dataOrder = Order::find()
        ->where("userId ='" . Yii::$app->user->id . "' and status > " . Order::ORDER_STATUS_REGISTER_USER . "")->all();
        foreach ($dataOrder as $items) {
            $products[$value->orderId] = [
                'orderNo' => $value->orderNo,
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

}
