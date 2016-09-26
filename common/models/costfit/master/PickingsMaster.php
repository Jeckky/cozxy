<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "pickings".
*
    * @property string $pickingsId
    * @property string $pickingId
    * @property string $userId
    * @property string $status
    * @property string $isDefault
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $countryId
    * @property integer $provinceId
    * @property integer $pickingscol
    * @property integer $amphurId
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
            [['pickingsId', 'pickingId', 'userId', 'provinceId', 'pickingscol', 'amphurId'], 'required'],
            [['pickingsId', 'pickingId', 'userId', 'provinceId', 'pickingscol', 'amphurId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status', 'isDefault', 'countryId'], 'string', 'max' => 45],
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
    'countryId' => Yii::t('pickings', 'Country ID'),
    'provinceId' => Yii::t('pickings', 'Province ID'),
    'pickingscol' => Yii::t('pickings', 'Pickingscol'),
    'amphurId' => Yii::t('pickings', 'Amphur ID'),
];
}
}
