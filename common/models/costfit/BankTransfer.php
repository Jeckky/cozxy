<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\BankTransferMaster;

/**
* This is the model class for table "bank_transfer".
*
    * @property string $bankTransferId
    * @property string $paymentMethodId
    * @property string $bankId
    * @property string $branch
    * @property string $accNo
    * @property string $accName
    * @property string $accType
    * @property string $compCode
    * @property string $supplierId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class BankTransfer extends \common\models\costfit\master\BankTransferMaster{
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
