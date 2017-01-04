<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\BankNameMaster;

/**
* This is the model class for table "bank_name".
*
    * @property string $bankNameId
    * @property string $title
    * @property string $description
    * @property string $logo
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Bank[] $banks
    */

class BankName extends \common\models\costfit\master\BankNameMaster{
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
