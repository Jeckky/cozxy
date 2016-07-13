<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "bank".
*
    * @property string $bankId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class BankMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'bank';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['description'], 'string'],
            [['status'], 'integer'],
            [['createDateTime'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'bankId' => Yii::t('bank', 'Bank ID'),
    'title' => Yii::t('bank', 'Title'),
    'description' => Yii::t('bank', 'Description'),
    'image' => Yii::t('bank', 'Image'),
    'status' => Yii::t('bank', 'Status'),
    'createDateTime' => Yii::t('bank', 'Create Date Time'),
    'updateDateTime' => Yii::t('bank', 'Update Date Time'),
];
}
}
