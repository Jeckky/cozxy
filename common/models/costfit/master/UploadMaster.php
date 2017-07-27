<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "upload".
*
    * @property string $uploadId
    * @property string $name
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UploadMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'upload';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['status'], 'integer'],
            [['createDateTime'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name'], 'string', 'max' => 225],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'uploadId' => Yii::t('upload', 'Upload ID'),
    'name' => Yii::t('upload', 'Name'),
    'status' => Yii::t('upload', 'Status'),
    'createDateTime' => Yii::t('upload', 'Create Date Time'),
    'updateDateTime' => Yii::t('upload', 'Update Date Time'),
];
}
}
