<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "forget_password".
*
    * @property string $forgetId
    * @property string $email
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ForgetPasswordMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'forget_password';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['status'], 'integer'],
            [['createDateTime'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['email'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'forgetId' => Yii::t('forget_password', 'Forget ID'),
    'email' => Yii::t('forget_password', 'Email'),
    'status' => Yii::t('forget_password', 'Status'),
    'createDateTime' => Yii::t('forget_password', 'Create Date Time'),
    'updateDateTime' => Yii::t('forget_password', 'Update Date Time'),
];
}
}
