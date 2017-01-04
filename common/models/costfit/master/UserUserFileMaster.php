<?php

namespace common\models\costfit\master;

use Yii;

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
class UserUserFileMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_user_file';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'userFileId', 'status', 'createDateTime'], 'required'],
            [['userId', 'userFileId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['filePath'], 'string', 'max' => 2000],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('user_user_file', 'ID'),
    'userId' => Yii::t('user_user_file', 'User ID'),
    'userFileId' => Yii::t('user_user_file', 'User File ID'),
    'filePath' => Yii::t('user_user_file', 'File Path'),
    'status' => Yii::t('user_user_file', 'Status'),
    'createDateTime' => Yii::t('user_user_file', 'Create Date Time'),
    'updateDateTime' => Yii::t('user_user_file', 'Update Date Time'),
];
}
}
