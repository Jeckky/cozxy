<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "point_used".
*
    * @property string $pointUsedId
    * @property integer $userId
    * @property integer $orderId
    * @property integer $point
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PointUsedMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'point_used';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'orderId', 'point', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pointUsedId' => Yii::t('point_used', 'Point Used ID'),
    'userId' => Yii::t('point_used', 'User ID'),
    'orderId' => Yii::t('point_used', 'Order ID'),
    'point' => Yii::t('point_used', 'Point'),
    'status' => Yii::t('point_used', 'Status'),
    'createDateTime' => Yii::t('point_used', 'Create Date Time'),
    'updateDateTime' => Yii::t('point_used', 'Update Date Time'),
];
}
}
