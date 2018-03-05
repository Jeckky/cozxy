<?php

namespace common\models\worlddb;

use Yii;
use \common\models\worlddb\master\User as UserModel;
use \common\models\worlddb\query\UserQuery;
/**
* This is the model class for table "user".
*
* @property string $id
* @property string $username
* @property string $auth_key
* @property string $password_hash
* @property string $password_reset_token
* @property string $email
* @property integer $status
* @property integer $created_at
* @property integer $updated_at
*
* @property UserInfo[] $userInfos
*/

class User extends UserModel
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
    * @return \common\models\worlddb\query\UserQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
