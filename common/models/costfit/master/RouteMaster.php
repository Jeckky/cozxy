<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "route".
*
    * @property string $name
    * @property string $alias
    * @property string $type
    * @property integer $status
*/
class RouteMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'route';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['name', 'alias', 'type'], 'required'],
            [['status'], 'integer'],
            [['name', 'alias', 'type'], 'string', 'max' => 64],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'name' => Yii::t('route', 'Name'),
    'alias' => Yii::t('route', 'Alias'),
    'type' => Yii::t('route', 'Type'),
    'status' => Yii::t('route', 'Status'),
];
}
}
