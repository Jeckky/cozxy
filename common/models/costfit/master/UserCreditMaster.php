<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_credit".
*
    * @property string $userCreditId
    * @property integer $userId
    * @property integer $totalCredit
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserCreditMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_credit';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'totalCredit'], 'required'],
            [['userId', 'totalCredit', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userCreditId' => Yii::t('user_credit', 'User Credit ID'),
    'userId' => Yii::t('user_credit', 'User ID'),
    'totalCredit' => Yii::t('user_credit', 'Total Credit'),
    'status' => Yii::t('user_credit', 'Status'),
    'createDateTime' => Yii::t('user_credit', 'Create Date Time'),
    'updateDateTime' => Yii::t('user_credit', 'Update Date Time'),
];
}
}
