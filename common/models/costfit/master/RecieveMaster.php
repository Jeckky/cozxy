<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "recieve".
*
    * @property string $recieveId
    * @property string $orderId
    * @property string $userId
    * @property string $pickingId
    * @property string $password
    * @property integer $isUse
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class RecieveMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'recieve';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderId', 'userId', 'pickingId'], 'required'],
            [['orderId', 'userId', 'pickingId', 'isUse', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['password'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'recieveId' => Yii::t('recieve', 'Recieve ID'),
    'orderId' => Yii::t('recieve', 'Order ID'),
    'userId' => Yii::t('recieve', 'User ID'),
    'pickingId' => Yii::t('recieve', 'Picking ID'),
    'password' => Yii::t('recieve', 'Password'),
    'isUse' => Yii::t('recieve', 'Is Use'),
    'status' => Yii::t('recieve', 'Status'),
    'createDateTime' => Yii::t('recieve', 'Create Date Time'),
    'updateDateTime' => Yii::t('recieve', 'Update Date Time'),
];
}
}
