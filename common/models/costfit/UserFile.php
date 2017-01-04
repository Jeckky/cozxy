<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserFileMaster;

/**
* This is the model class for table "user_file".
*
    * @property string $userFileId
    * @property string $userFileName
    * @property integer $type
    * @property integer $status
    * @property integer $isShowInProductView
    * @property integer $isPublic
    * @property string $createDateTime
*/

class UserFile extends \common\models\costfit\master\UserFileMaster{
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
