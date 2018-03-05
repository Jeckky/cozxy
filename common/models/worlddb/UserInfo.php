<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\UserInfo as UserInfoModel;
use \common\models\worlddb\query\UserInfoQuery;
/**
* This is the model class for table "user_info".
*
* @property string $userInfoId
* @property string $userId
* @property integer $status
* @property string $firstname
* @property string $lastname
* @property integer $createDateTime
* @property integer $updateDateTime
*
* @property User $user
*/

class UserInfo extends UserInfoModel
{
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

    /**
    * @inheritdoc
    * @return \common\models\worlddb\query\UserInfoQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new UserInfoQuery(get_called_class());
    }
}
