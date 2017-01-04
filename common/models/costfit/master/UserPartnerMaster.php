<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_partner".
*
    * @property string $userPartnerId
    * @property string $userId
    * @property string $partnerId
    * @property string $partnerCode
    * @property integer $partnerType
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserPartnerMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_partner';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'partnerCode', 'createDateTime'], 'required'],
            [['userId', 'partnerId', 'partnerType', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['partnerCode'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userPartnerId' => Yii::t('user_partner', 'User Partner ID'),
    'userId' => Yii::t('user_partner', 'User ID'),
    'partnerId' => Yii::t('user_partner', 'Partner ID'),
    'partnerCode' => Yii::t('user_partner', 'Partner Code'),
    'partnerType' => Yii::t('user_partner', 'Partner Type'),
    'status' => Yii::t('user_partner', 'Status'),
    'createDateTime' => Yii::t('user_partner', 'Create Date Time'),
    'updateDateTime' => Yii::t('user_partner', 'Update Date Time'),
];
}
}
