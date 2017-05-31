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

    public static function myAddress($addressId, $type = FALSE) {
        $products = [];
        $dataAddress = \common\models\costfit\Address::find()->where("addressId ='" . $addressId . "' and type =" . $type)->orderBy('addressId DESC')->all();
        foreach ($dataAddress as $items) {
            $products[$items->addressId] = [
                'addressId' => $items->addressId,
                'userId' => $items->userId,
                'firstname' => isset($items->firstname) ? $items->firstname : '',
                'lastname' => isset($items->lastname) ? $items->lastname : '',
                'company' => isset($items->company) ? $items->company : '',
                'tax' => isset($items->tax) ? $items->tax : '',
                'address' => isset($items->address) ? $items->address : '' . ' , ',
                'country' => isset($items->countries->countryName) ? $items->countries->countryName : '' . ' , ',
                'province' => isset($items->states->localName) ? $items->states->localName : '' . ' , ',
                'amphur' => isset($items->cities->localName) ? $items->cities->localName : '' . ' , ',
                'district' => isset($items->district->localName) ? $items->district->localName : '' . ' , ',
                'zipcode' => isset($items->zipcodes->zipcode) ? $items->zipcodes->zipcode : '' . ' , ',
                'tel' => isset($items->tel) ? $items->tel : '',
                'type' => isset($items->type) ? $items->type : '',
                'isDefault' => isset($items->isDefault) ? $items->isDefault : '',
                'status' => isset($items->status) ? $items->status : '',
                'createDateTime' => isset($items->createDateTime) ? $items->createDateTime : '',
                'updateDateTime' => isset($items->updateDateTime) ? $items->updateDateTime : '',
                'email' => isset($items->email) ? $items->email : '',
            ];
        }
        return $products;
    }

}
