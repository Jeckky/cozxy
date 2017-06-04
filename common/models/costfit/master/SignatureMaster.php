<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "signature".
*
    * @property integer $signatureId
    * @property integer $userId
    * @property string $position
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SignatureMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'signature';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId'], 'required'],
            [['userId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['position', 'image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'signatureId' => Yii::t('signature', 'Signature ID'),
    'userId' => Yii::t('signature', 'User ID'),
    'position' => Yii::t('signature', 'Position'),
    'image' => Yii::t('signature', 'Image'),
    'status' => Yii::t('signature', 'Status'),
    'createDateTime' => Yii::t('signature', 'Create Date Time'),
    'updateDateTime' => Yii::t('signature', 'Update Date Time'),
];
}
}
