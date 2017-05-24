<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\costfit\Address;
use common\models\costfit\User;
use common\models\costfit\UserPoint;

/**
 * ContactForm is the model behind the contact form.
 */
class DisplayMyAccount extends Model {

    public static function myAccountBillingAddress($status, $type) {
        $products = [];
        $dataAddress = Address::find()->where("userId ='" . Yii::$app->user->id . "' and type =" . $type)->orderBy('addressId DESC')->all();
        foreach ($dataAddress as $items) {
            $products[$items->addressId] = [
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
                'zipcode' => $items->zipcode,
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
        ];
        return $products;
    }

    public static function myAccountCozxyCoin($status, $type) {
        $products = [];
        $dataUserPoint = UserPoint::find()->where('userId=' . \Yii::$app->user->id)->one();
        $products[$dataUserPoint['userPointId']] = [
            'userPointId' => $dataUserPoint['userPointId'],
            'userId' => isset($dataUserPoint['userId']) ? $dataUserPoint['userId'] : '-',
            'currentPoint' => isset($dataUserPoint['currentPoint']) ? number_format($dataUserPoint['currentPoint'], 2) : '0',
            'totalPoint' => isset($dataUserPoint['totalPoint']) ? number_format($dataUserPoint['totalPoint'], 2) : '0',
            'totalMoney' => isset($dataUserPoint['totalMoney']) ? number_format($dataUserPoint['totalMoney'], 2) : '0',
            'totalMoney' => isset($dataUserPoint['updateDateTime']) ? $dataUserPoint['updateDateTime'] : '-',
        ];
        return $products;
    }

}
