<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ForgetPasswordMaster;

/**
* This is the model class for table "forget_password".
*
    * @property string $forgetId
    * @property string $email
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ForgetPassword extends \common\models\costfit\master\ForgetPasswordMaster{
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
