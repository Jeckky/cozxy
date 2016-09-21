<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "pickings".
*
    * @property integer $pickingsId
    * @property integer $pickingId
    * @property string $userId
    * @property string $status
    * @property string $isDefault
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PickingsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'pickings';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['pickingId', 'userId'], 'required'],
            [['pickingId', 'userId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status', 'isDefault'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pickingsId' => Yii::t('pickings', 'Pickings ID'),
    'pickingId' => Yii::t('pickings', 'Picking ID'),
    'userId' => Yii::t('pickings', 'User ID'),
    'status' => Yii::t('pickings', 'Status'),
    'isDefault' => Yii::t('pickings', 'Is Default'),
    'createDateTime' => Yii::t('pickings', 'Create Date Time'),
    'updateDateTime' => Yii::t('pickings', 'Update Date Time'),
];
}
}
