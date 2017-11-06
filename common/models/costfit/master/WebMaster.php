<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "web".
*
    * @property integer $webId
    * @property string $title
    * @property string $company
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class WebMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'web';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'company'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'webId' => Yii::t('web', 'Web ID'),
    'title' => Yii::t('web', 'Title'),
    'company' => Yii::t('web', 'Company'),
    'status' => Yii::t('web', 'Status'),
    'createDateTime' => Yii::t('web', 'Create Date Time'),
    'updateDateTime' => Yii::t('web', 'Update Date Time'),
];
}
}
