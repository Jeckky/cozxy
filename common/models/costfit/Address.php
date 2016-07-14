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
 *
 * @property User $user
 */
class Address extends \common\models\costfit\master\AddressMaster {

    const TYPE_BILLING = 1; // ที่อยู่จัดส่งเอกสาร
    const TYPE_SHIPPING = 2; // ที่อยู่จัดส่งสินค้า

    /**
     * @inheritdoc
     */

    public function rules() {

        return array_merge(parent::rules(), [
            [ ['company', 'address', 'countryId', 'provinceId', 'amphurId', 'zipcode', 'type', 'isDefault', 'status', 'tel']
                , 'required', 'on' => 'shipping_address'],
            ['tel', 'number'],
            ['zipcode', 'number']
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

}
