<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\AddressPartnerFileMaster;

/**
* This is the model class for table "address_partner_file".
*
    * @property string $pfId
    * @property string $userId
    * @property string $name
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class AddressPartnerFile extends \common\models\costfit\master\AddressPartnerFileMaster{
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
