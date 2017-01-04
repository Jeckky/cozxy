<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderFileMaster;

/**
* This is the model class for table "order_file".
*
    * @property string $orderFileId
    * @property string $orderId
    * @property string $fileName
    * @property string $filePath
    * @property string $senderId
    * @property string $receiverId
    * @property integer $userType
    * @property integer $status
    * @property string $createDateTime
*/

class OrderFile extends \common\models\costfit\master\OrderFileMaster{
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
