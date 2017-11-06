<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_groups".
*
    * @property integer $user_group_Id
    * @property string $name
    * @property string $parent_id
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserGroupsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_groups';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['parent_id', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'user_group_Id' => Yii::t('user_groups', 'User Group  ID'),
    'name' => Yii::t('user_groups', 'Name'),
    'parent_id' => Yii::t('user_groups', 'Parent ID'),
    'status' => Yii::t('user_groups', 'Status'),
    'createDateTime' => Yii::t('user_groups', 'Create Date Time'),
    'updateDateTime' => Yii::t('user_groups', 'Update Date Time'),
];
}
}
