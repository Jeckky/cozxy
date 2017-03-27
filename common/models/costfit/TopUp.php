<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\TopUpMaster;

/**
* This is the model class for table "top_up".
*
    * @property string $topUpId
    * @property integer $userId
    * @property integer $money
    * @property integer $point
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class TopUp extends \common\models\costfit\master\TopUpMaster{
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
