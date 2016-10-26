<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "package_type".
*
    * @property string $packageTypeId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PackageTypeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'package_type';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'packageTypeId' => Yii::t('package_type', 'Package Type ID'),
    'title' => Yii::t('package_type', 'Title'),
    'description' => Yii::t('package_type', 'Description'),
    'status' => Yii::t('package_type', 'Status'),
    'createDateTime' => Yii::t('package_type', 'Create Date Time'),
    'updateDateTime' => Yii::t('package_type', 'Update Date Time'),
];
}
}
