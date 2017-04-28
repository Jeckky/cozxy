<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_visit".
*
    * @property string $visitId
    * @property integer $userId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $lastvisitDate
    * @property string $device
*/
class UserVisitMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_visit';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'createDateTime'], 'required'],
            [['userId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime', 'lastvisitDate'], 'safe'],
            [['device'], 'string', 'max' => 100],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'visitId' => Yii::t('user_visit', 'Visit ID'),
    'userId' => Yii::t('user_visit', 'User ID'),
    'status' => Yii::t('user_visit', 'Status'),
    'createDateTime' => Yii::t('user_visit', 'Create Date Time'),
    'updateDateTime' => Yii::t('user_visit', 'Update Date Time'),
    'lastvisitDate' => Yii::t('user_visit', 'Lastvisit Date'),
    'device' => Yii::t('user_visit', 'Device'),
];
}
}
