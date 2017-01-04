<?php

namespace common\models\costfit\master;

use Yii;

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
class UserFileMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_file';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userFileName', 'type', 'status', 'createDateTime'], 'required'],
            [['type', 'status', 'isShowInProductView', 'isPublic'], 'integer'],
            [['createDateTime'], 'safe'],
            [['userFileName'], 'string', 'max' => 500],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userFileId' => Yii::t('user_file', 'User File ID'),
    'userFileName' => Yii::t('user_file', 'User File Name'),
    'type' => Yii::t('user_file', 'Type'),
    'status' => Yii::t('user_file', 'Status'),
    'isShowInProductView' => Yii::t('user_file', 'Is Show In Product View'),
    'isPublic' => Yii::t('user_file', 'Is Public'),
    'createDateTime' => Yii::t('user_file', 'Create Date Time'),
];
}
}
