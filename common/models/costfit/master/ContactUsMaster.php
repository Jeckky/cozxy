<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "contact_us".
*
    * @property string $contactId
    * @property string $fullname
    * @property string $email
    * @property string $massage
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class ContactUsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'contact_us';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['fullname', 'email', 'massage', 'createDateTime'], 'required'],
            [['massage'], 'string'],
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['fullname', 'email'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'contactId' => Yii::t('contact_us', 'Contact ID'),
    'fullname' => Yii::t('contact_us', 'Fullname'),
    'email' => Yii::t('contact_us', 'Email'),
    'massage' => Yii::t('contact_us', 'Massage'),
    'status' => Yii::t('contact_us', 'Status'),
    'createDateTime' => Yii::t('contact_us', 'Create Date Time'),
    'updateDateTime' => Yii::t('contact_us', 'Update Date Time'),
];
}
}
