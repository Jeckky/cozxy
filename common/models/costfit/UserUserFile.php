<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserUserFileMaster;

/**
* This is the model class for table "user_user_file".
*
    * @property string $id
    * @property string $userId
    * @property string $userFileId
    * @property string $filePath
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class UserUserFile extends \common\models\costfit\master\UserUserFileMaster{
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
