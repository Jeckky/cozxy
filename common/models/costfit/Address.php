<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\AddressMaster;

/**
 * This is the model class for table "address".
 *
 * @property string $addressId
 * @property string $userId
 * @property string $company
 * @property string $tax
 * @property string $address
 * @property string $countryId
 * @property string $provinceId
 * @property string $amphurId
 * @property string $zipcode
 * @property string $tel
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $firstname
 * @property string $lastname
 *
 * @property User $user
 */
class Address extends \common\models\costfit\master\AddressMaster {

    const TYPE_BILLING = 1; // ที่อยู่จัดส่งเอกสาร
    const TYPE_SHIPPING = 2; // ที่อยู่จัดส่งสินค้า
    const TYPE_PICKINGPOINT = 3; // ที่อยู่จัดส่งสินค้า

    public $districtCode;

    /**
     * @inheritdoc
     */
    public function rules() {

        return array_merge(parent::rules(), [//, 'countryId'
                [['firstname', 'lastname', 'address', 'provinceId', 'amphurId', 'zipcode', 'type', 'isDefault', 'status', 'tel']
                , 'required', 'on' => 'shipping_address'],
                ['tel', 'number'],
                ['zipcode', 'number'],
                [['countryId', 'firstname', 'lastname', 'address', 'provinceId', 'amphurId', 'districtId', 'zipcode', 'email']
                , 'required', 'on' => 'checkout-billing-address'],
                [['provinceId', 'amphurId', 'addressId'], 'required', 'on' => 'billing_address'],
                [['countryId', 'firstname', 'lastname', 'address', 'provinceId', 'amphurId', 'zipcode', 'type', 'isDefault', 'status', 'tel', 'email']
                , 'required', 'on' => 'new_checkouts_billing_address'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getTypeArray() {
        return [
            self::TYPE_BILLING => 'ที่อยู่ออกใบกำกับภาษี',
            self::TYPE_SHIPPING => 'ที่อยู่จัดส่งสินค้า',
        ];
    }

    public function getTypeText($type) {
        $res = $this->getTypeArray();
        if (isset($res[$type])) {
            return $res[$type];
        } else {
            return NULL;
        }
    }

    public function getCities() {
        return $this->hasOne(\common\models\dbworld\Cities::className(), ['cityId' => 'amphurId']);
    }

    public function getCountries() {
        return $this->hasOne(\common\models\dbworld\Countries::className(), ['countryId' => 'countryId']);
    }

    public function getDistrict() {
        return $this->hasOne(\common\models\dbworld\District::className(), ['districtId' => 'districtId']);
    }

    public function getStates() {
        return $this->hasOne(\common\models\dbworld\States::className(), ['stateId' => 'provinceId']);
    }

    public function getZipcodes() {
        return $this->hasOne(\common\models\dbworld\Zipcodes::className(), ['zipcodeId' => 'zipcode']);
    }

    /*
     * increate : 20/10/2559
     * use : management/address/
     * by : taninut.b
     */

    public function getCitie() {
        return $this->hasOne(\common\models\dbworld\Cities::className(), ['cityId' => 'amphurId']);
    }

    public function getCountrie() {
        return $this->hasOne(\common\models\dbworld\Countries::className(), ['countryId' => 'countryId']);
    }

    public function getState() {
        return $this->hasOne(\common\models\dbworld\States::className(), ['stateId' => 'provinceId']);
    }

    public static function CompanyName($userId) {
        $address = Address::find()->where("userId=" . $userId . " and status=1 and isDefault=1")->one();
        if (isset($address)) {
            if ($address->company != NULL || $address->company != '') {
                return $address->company;
            } else {
                return $address->firstname . " " . $address->lastname;
            }
        } else {
            $address2 = Address::find()->where("userId=" . $userId . " and status=1")
                    ->orderBy("createDateTime")
                    ->one();
            if (isset($address2)) {
                if ($address2->company != NULL || $address2->company != '') {
                    return $address2->company;
                } else {
                    return $address2->firstname . " " . $address2->lastname;
                }
            } else {
                return '';
            }
        }
    }

    public static function userName($userId) {
        $address = Address::find()->where("userId=" . $userId . " and status=1 and isDefault=1")->one();
        if (isset($address)) {
            $name = $address->firstname . ' ' . $address->lastname;
            return $name;
        } else {
            $address2 = Address::find()->where("userId=" . $userId . " and status=1")
                    ->orderBy("createDateTime DESC")
                    ->one();
            if (isset($address2)) {
                $name = $address2->firstname . ' ' . $address2->lastname;
                return $name;
            } else {
                return '';
            }
        }
    }

    public static function userTel($userId) {
        $address = Address::find()->where("userId=" . $userId . " and status=1 and isDefault=1")->one();
        if (isset($address)) {
            $tel = $address->tel;
            return $tel;
        } else {
            $address2 = Address::find()->where("userId=" . $userId . " and status=1")
                    ->orderBy("createDateTime DESC")
                    ->one();
            if (isset($address2)) {
                $tel = $address2->tel;
                return $tel;
            } else {
                return null;
            }
        }
    }

    public static function CompanyByOderId($orderId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $address = Address::find()->where("userId=" . $order->userId . " and status=1 and isDefault=1")->one();
        if (isset($address) && !empty($address)) {
            return $address;
        } else {
            $address2 = Address::find()->where("userId=" . $order->userId . " and status=1")
                    ->orderBy("createDateTime DESC")
                    ->one();
            if (isset($address2)) {
                return $address2;
            } else {
                return null;
            }
        }
    }

}
