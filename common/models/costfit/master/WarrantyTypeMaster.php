<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "warranty_type".
*
    * @property string $warrantyTypeId
    * @property string $title
    * @property string $defimition
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class WarrantyTypeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'warranty_type';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['defimition'], 'string'],
            [['status'], 'integer'],
            [['createDateTime'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'warrantyTypeId' => Yii::t('warranty_type', 'Warranty Type ID'),
    'title' => Yii::t('warranty_type', 'Title'),
    'defimition' => Yii::t('warranty_type', 'Defimition'),
    'status' => Yii::t('warranty_type', 'Status'),
    'createDateTime' => Yii::t('warranty_type', 'Create Date Time'),
    'updateDateTime' => Yii::t('warranty_type', 'Update Date Time'),
];
}
}
