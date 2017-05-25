<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_point".
*
    * @property string $userPointId
    * @property integer $userId
    * @property integer $currentPoint
    * @property integer $totalPoint
    * @property integer $totalMoney
    * @property integer $status
    * @property string $createDateTime
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
            [['createDateTime', 'updateDateTime'], 'safe'],
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
    'createDateTime' => Yii::t('user_point', 'Create Date Time'),
    'updateDateTime' => Yii::t('user_point', 'Update Date Time'),
];
}
}
