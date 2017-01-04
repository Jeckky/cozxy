<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserPartnerMaster;

/**
* This is the model class for table "user_partner".
*
    * @property string $userPartnerId
    * @property string $userId
    * @property string $partnerId
    * @property string $partnerCode
    * @property integer $partnerType
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class UserPartner extends \common\models\costfit\master\UserPartnerMaster{
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
