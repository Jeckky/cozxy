<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "picking_point_type".
*
    * @property integer $pptId
    * @property string $name
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PickingPointTypeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'picking_point_type';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 150],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pptId' => Yii::t('picking_point_type', 'Ppt ID'),
    'name' => Yii::t('picking_point_type', 'Name'),
    'description' => Yii::t('picking_point_type', 'Description'),
    'status' => Yii::t('picking_point_type', 'Status'),
    'createDateTime' => Yii::t('picking_point_type', 'Create Date Time'),
    'updateDateTime' => Yii::t('picking_point_type', 'Update Date Time'),
];
}
}
