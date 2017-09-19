<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "subscribe".
*
    * @property string $subscribeId
    * @property string $email
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SubscribeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'subscribe';
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
            [['email'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'subscribeId' => Yii::t('subscribe', 'Subscribe ID'),
    'email' => Yii::t('subscribe', 'Email'),
    'status' => Yii::t('subscribe', 'Status'),
    'createDateTime' => Yii::t('subscribe', 'Create Date Time'),
    'updateDateTime' => Yii::t('subscribe', 'Update Date Time'),
];
}
}
