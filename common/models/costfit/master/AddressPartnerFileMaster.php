<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "address_partner_file".
*
    * @property string $pfId
    * @property string $userId
    * @property string $name
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class AddressPartnerFileMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'address_partner_file';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'createDateTime'], 'required'],
            [['userId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pfId' => Yii::t('address_partner_file', 'Pf ID'),
    'userId' => Yii::t('address_partner_file', 'User ID'),
    'name' => Yii::t('address_partner_file', 'Name'),
    'status' => Yii::t('address_partner_file', 'Status'),
    'createDateTime' => Yii::t('address_partner_file', 'Create Date Time'),
    'updateDateTime' => Yii::t('address_partner_file', 'Update Date Time'),
];
}
}
