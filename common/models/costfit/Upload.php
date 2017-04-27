<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UploadMaster;

/**
* This is the model class for table "upload".
*
    * @property string $uploadId
    * @property string $userId
    * @property string $name
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Upload extends \common\models\costfit\master\UploadMaster{
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
