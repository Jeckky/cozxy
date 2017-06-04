<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "menu".
*
    * @property string $menuId
    * @property string $levelId
    * @property string $user_group_Id
    * @property string $parent_id
    * @property string $name
    * @property string $desc
    * @property string $link
    * @property integer $parents
    * @property integer $sort
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class MenuMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'menu';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['parent_id', 'parents', 'sort', 'status'], 'integer'],
            [['name', 'link'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['levelId', 'link'], 'string', 'max' => 100],
            [['user_group_Id', 'desc'], 'string', 'max' => 200],
            [['name'], 'string', 'max' => 50],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'menuId' => Yii::t('menu', 'Menu ID'),
    'levelId' => Yii::t('menu', 'Level ID'),
    'user_group_Id' => Yii::t('menu', 'User Group  ID'),
    'parent_id' => Yii::t('menu', 'Parent ID'),
    'name' => Yii::t('menu', 'Name'),
    'desc' => Yii::t('menu', 'Desc'),
    'link' => Yii::t('menu', 'Link'),
    'parents' => Yii::t('menu', 'Parents'),
    'sort' => Yii::t('menu', 'Sort'),
    'status' => Yii::t('menu', 'Status'),
    'createDateTime' => Yii::t('menu', 'Create Date Time'),
    'updateDateTime' => Yii::t('menu', 'Update Date Time'),
];
}
}
