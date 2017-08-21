<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\costfit\Address;
use common\models\costfit\User;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductPost;
use common\helpers\Base64Decode;

/**
 * ContactForm is the model behind the contact form.
 */
class DisplayMyAddress extends Model {

    public static function myAddresssSummary($addressId, $type = FALSE) {
        $products = [];
        $dataAddress = \common\models\costfit\Address::find()->where("addressId ='" . $addressId . "' and type =" . $type)->orderBy('addressId DESC')->one();
        //echo 'countryName : ' . $dataAddress->countries->countryName;
        $products['myAddresss'] = [
            'addressId' => $dataAddress['addressId'],
            'userId' => $dataAddress['userId'],
            'firstname' => isset($dataAddress['firstname']) ? $dataAddress['firstname'] : '',
            'lastname' => isset($dataAddress['lastname']) ? $dataAddress['lastname'] : '',
            'company' => isset($dataAddress['company']) ? $dataAddress['company'] : '',
            'tax' => isset($dataAddress['tax']) ? $dataAddress['tax'] : '',
            'address' => isset($dataAddress['address']) ? $dataAddress['address'] : '' . ', ',
            'country' => isset($dataAddress->countries) ? $dataAddress->countries->countryName : '' . ', ',
            'province' => isset($dataAddress->states) ? $dataAddress->states->localName : '' . ', ',
            'amphur' => isset($dataAddress->cities) ? $dataAddress->cities->localName : '' . ', ',
            'district' => isset($dataAddress->district) ? $dataAddress->district->localName : '' . ', ',
            'zipcode' => isset($dataAddress->zipcodes) ? $dataAddress->zipcodes->zipcode : '' . ', ',
            'tel' => isset($dataAddress['tel']) ? $dataAddress['tel'] : '',
            'type' => isset($dataAddress['type']) ? $dataAddress['type'] : '',
            'isDefault' => isset($dataAddress['isDefault']) ? $dataAddress['isDefault'] : '',
            'status' => isset($dataAddress['status']) ? $dataAddress['status'] : '',
            'createDateTime' => isset($dataAddress['createDateTime']) ? $dataAddress['createDateTime'] : '',
            'updateDateTime' => isset($dataAddress['updateDateTime']) ? $dataAddress['updateDateTime'] : '',
            'email' => isset($dataAddress['email']) ? $dataAddress['email'] : '',
        ];

        return $products;
    }

}
