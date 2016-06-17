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

class Address extends \common\models\costfit\master\AddressMaster{
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
}
