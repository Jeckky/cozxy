<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ContactUsMaster;

/**
* This is the model class for table "contact_us".
*
    * @property string $contactId
    * @property string $fullname
    * @property string $email
    * @property string $massage
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ContactUs extends \common\models\costfit\master\ContactUsMaster{
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
