<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderGroupSendWorkMaster;

/**
* This is the model class for table "order_group_send_work".
*
    * @property string $orderGroupSendWorkId
    * @property string $orderGroupId
    * @property integer $seq
    * @property string $title
    * @property string $image
    * @property string $remark
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class OrderGroupSendWork extends \common\models\costfit\master\OrderGroupSendWorkMaster{
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
