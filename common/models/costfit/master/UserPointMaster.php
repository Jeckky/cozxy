<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_point".
*
    * @property string $userPointId
    * @property string $userId
    * @property string $currentPoint
    * @property string $totalPoint
    * @property string $totalMoney
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserPointMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_point';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'currentPoint', 'totalPoint', 'totalMoney'], 'required'],
            [['userId', 'currentPoint', 'totalPoint', 'totalMoney', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userPointId' => Yii::t('user_point', 'User Point ID'),
    'userId' => Yii::t('user_point', 'User ID'),
    'currentPoint' => Yii::t('user_point', 'Current Point'),
    'totalPoint' => Yii::t('user_point', 'Total Point'),
    'totalMoney' => Yii::t('user_point', 'Total Money'),
    'status' => Yii::t('user_point', 'Status'),
    'createDateTime' => Yii::t('user_point', 'Create Date Time'),
    'updateDateTime' => Yii::t('user_point', 'Update Date Time'),
];
}
}
