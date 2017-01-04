<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderGroupFileMaster;

/**
* This is the model class for table "order_group_file".
*
    * @property string $orderGroupFileId
    * @property string $orderGroupId
    * @property string $fileName
    * @property string $filePath
    * @property string $senderId
    * @property string $receiverId
    * @property integer $userType
    * @property integer $status
    * @property string $createDateTime
*/

class OrderGroupFile extends \common\models\costfit\master\OrderGroupFileMaster{
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
