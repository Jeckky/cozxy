<?php

namespace common\models\worlddb\master;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property string $userInfoId
 * @property string $userId
 * @property int $status
 * @property string $firstname
 * @property string $lastname
 * @property int $createDateTime
 * @property int $updateDateTime
 *
 * @property User $user
 */
class UserInfo extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'createDateTime', 'updateDateTime'], 'required'],
            [['userId', 'status', 'createDateTime', 'updateDateTime'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 200],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userInfoId' => 'User Info ID',
            'userId' => 'User ID',
            'status' => 'Status',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
