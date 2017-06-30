<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\AddressPartnerBankMaster;

/**
* This is the model class for table "address_partner_bank".
*
    * @property string $pbId
    * @property string $userId
    * @property string $bankName
    * @property string $accountHolderName
    * @property string $accountNo
    * @property string $branchName
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class AddressPartnerBank extends \common\models\costfit\master\AddressPartnerBankMaster{
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
