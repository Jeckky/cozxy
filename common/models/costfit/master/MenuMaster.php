<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "menu".
*
    * @property string $menuId
    * @property string $levelId
    * @property string $name
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
            [['levelId', 'name', 'link'], 'required'],
            [['parents', 'sort', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['levelId', 'link'], 'string', 'max' => 100],
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
    'name' => Yii::t('menu', 'Name'),
    'link' => Yii::t('menu', 'Link'),
    'parents' => Yii::t('menu', 'Parents'),
    'sort' => Yii::t('menu', 'Sort'),
    'status' => Yii::t('menu', 'Status'),
    'createDateTime' => Yii::t('menu', 'Create Date Time'),
    'updateDateTime' => Yii::t('menu', 'Update Date Time'),
];
}
}
